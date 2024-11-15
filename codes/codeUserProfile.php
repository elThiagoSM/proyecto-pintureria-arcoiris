<?php
session_start();
include '../database/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $maxDim = 512;

        // Define directamente las rutas de carga y acceso web
        $projectPath = '/proyecto-pintureria-arcoiris';
        $uploadsDir = $_SERVER['DOCUMENT_ROOT'] . $projectPath . '/uploads/profile_pictures/' . $_SESSION['nombre_usuario'] . '/';
        $webPath = 'http://localhost' . $projectPath . '/uploads/profile_pictures/' . $_SESSION['nombre_usuario'] . '/';

        if (!is_dir($uploadsDir)) {
            mkdir($uploadsDir, 0755, true);
        }

        // Obtener el formato de la imagen
        $fileTmpPath = $_FILES['profile_image']['tmp_name'];
        list($width, $height, $imageType) = getimagesize($fileTmpPath);

        // Determinar extensión en función del tipo de imagen
        switch ($imageType) {
            case IMAGETYPE_JPEG:
                $srcImage = imagecreatefromjpeg($fileTmpPath);
                $fileExtension = '.jpg';
                break;
            case IMAGETYPE_PNG:
                $srcImage = imagecreatefrompng($fileTmpPath);
                $fileExtension = '.png';
                break;
            case IMAGETYPE_GIF:
                $srcImage = imagecreatefromgif($fileTmpPath);
                $fileExtension = '.gif';
                break;
            default:
                header("Location: ../userProfile.php?upload=error_type");
                exit();
        }

        // Asignar nombre incremental para evitar sobrescritura
        $baseFileName = $_SESSION['nombre_usuario'];
        $fileName = $baseFileName . $fileExtension;
        $destPath = $uploadsDir . $fileName;
        $counter = 1;
        while (file_exists($destPath)) {
            $fileName = $baseFileName . '_' . $counter . $fileExtension;
            $destPath = $uploadsDir . $fileName;
            $counter++;
        }

        // Redimensionar la imagen
        $srcAspect = $width / $height;
        $newWidth = $maxDim;
        $newHeight = $maxDim;
        if ($srcAspect > 1) {
            $tempHeight = $maxDim / $srcAspect;
            $tempWidth = $maxDim;
            $srcX = 0;
            $srcY = ($height - $width) / 2;
        } else {
            $tempWidth = $maxDim * $srcAspect;
            $tempHeight = $maxDim;
            $srcY = 0;
            $srcX = ($width - $height) / 2;
        }

        $dstImage = imagecreatetruecolor($maxDim, $maxDim);
        if ($imageType == IMAGETYPE_PNG || $imageType == IMAGETYPE_GIF) {
            imagecolortransparent($dstImage, imagecolorallocatealpha($dstImage, 0, 0, 0, 127));
            imagealphablending($dstImage, false);
            imagesavealpha($dstImage, true);
        }

        imagecopyresampled($dstImage, $srcImage, 0, 0, $srcX, $srcY, $maxDim, $maxDim, $width, $height);

        switch ($imageType) {
            case IMAGETYPE_JPEG:
                imagejpeg($dstImage, $destPath, 90);
                break;
            case IMAGETYPE_PNG:
                imagepng($dstImage, $destPath);
                break;
            case IMAGETYPE_GIF:
                imagegif($dstImage, $destPath);
                break;
        }

        imagedestroy($srcImage);
        imagedestroy($dstImage);

        $_SESSION['foto_perfil'] = $webPath . $fileName;
        $id_usuario = $_SESSION['id_usuario'];
        $stmt = $conn->prepare("UPDATE usuarios SET foto_perfil = ? WHERE id_usuario = ?");
        $stmt->bind_param("si", $_SESSION['foto_perfil'], $id_usuario);

        if ($stmt->execute()) {
            header("Location: ../userProfile.php?upload=success");
        } else {
            header("Location: ../userProfile.php?upload=db_error");
        }

        $stmt->close();
        $conn->close();
        exit();
    } else {
        header("Location: ../userProfile.php?upload=error");
        exit();
    }
}
