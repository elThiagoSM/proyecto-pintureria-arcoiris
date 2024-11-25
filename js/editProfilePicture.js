const profileImageInput = document.getElementById("profile-image-input");
const cropModal = document.getElementById("cropModal");
const image = document.getElementById("image");
const cropButton = document.getElementById("cropButton");
const profilePicPreview = document.getElementById("profile-pic-preview");

let cropper;

// Cuando el usuario selecciona un archvio
profileImageInput.addEventListener("change", (event) => {
  // Obtiene el archvio seleccionado
  const file = event.target.files[0];
  if (file) {
    // Convierte el archvio en una url de datos para usarse como src
    const reader = new FileReader();
    reader.onload = () => {
      image.src = reader.result;
      cropModal.style.display = "block";

      // Inicia y configura el Cropper.js
      image.onload = () => {
        if (cropper) cropper.destroy(); // Elimina cualquier cropper anterior
        cropper = new Cropper(image, {
          aspectRatio: 1, // Proporcion cuadrada
          viewMode: 1, // Restringe el recorte en los limites de la imagen
        });
      };
    };
    reader.readAsDataURL(file);
  }
});

// Funcion para recortar, ver y guardar la imagen
cropButton.addEventListener("click", () => {
  const canvas = cropper.getCroppedCanvas({
    width: 400,
    height: 400,
  });

  profilePicPreview.src = canvas.toDataURL("image/jpeg");

  // Convertir a Blob y subir usando Fetch (Binary Large Object)
  canvas.toBlob((blob) => {
    const formData = new FormData();
    formData.append("profile_image", blob, "recorte.jpg");

    fetch("codes/codeUserProfile.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        console.log("Imagen subida:", data);
        cropModal.style.display = "none";
        if (cropper) cropper.destroy();
        profileImageInput.value = "";
      })
      .catch((error) => {
        console.error("Error al subir la imagen:", error);
      });
  });
});
