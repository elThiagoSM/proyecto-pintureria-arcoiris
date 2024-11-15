<?php
include '../database/database.php';


$id_usuario = $_COOKIE['id_usuario'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $uploadsDir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/admin_profile_pictures/';
        $webPath = 'http://localhost/uploads/admin_profile_pictures/';

        if (!is_dir($uploadsDir)) {
            mkdir($uploadsDir, 0755, true);
        }

        $fileTmpPath = $_FILES['profile_image']['tmp_name'];
        list($width, $height, $imageType) = getimagesize($fileTmpPath);

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
                header("Location: ../adminProfile.php?upload=error_type");
                exit();
        }

        $fileName = 'admin_' . $id_usuario . $fileExtension;
        $destPath = $uploadsDir . $fileName;

        imagejpeg($srcImage, $destPath, 90);
        imagedestroy($srcImage);

        $photoPath = $webPath . $fileName;
        $stmt = $conn->prepare("UPDATE Usuarios SET foto_perfil = ? WHERE id_usuario = ?");
        $stmt->bind_param("si", $photoPath, $id_usuario);

        if ($stmt->execute()) {
            setcookie("foto_perfil", $photoPath, 0, "/");
            header("Location: ../adminProfile.php?upload=success");
        } else {
            header("Location: ../adminProfile.php?upload=db_error");
        }

        $stmt->close();
        $conn->close();
        exit();
    }

    if (isset($_POST['logout'])) {
        setcookie("id_usuario", "", time() - 3600, "/");
        setcookie("nombre_usuario", "", time() - 3600, "/");
        setcookie("correo", "", time() - 3600, "/");
        setcookie("clasificacion", "", time() - 3600, "/");
        setcookie("fecha_ingreso", "", time() - 3600, "/");
        setcookie("foto_perfil", "", time() - 3600, "/");

        header("Location: ../loginAdmin.php");
        exit();
    }
}
