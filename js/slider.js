let currentIndex = 0;
const slides = document.querySelectorAll(".carousel-slide");
const totalSlides = slides.length;

function autoSlide() {
  currentIndex++;
  if (currentIndex >= totalSlides) {
    currentIndex = 0;
  }
  document.querySelector(".carousel-track").style.transform = `translateX(-${
    currentIndex * 100
  }%)`;
}

setInterval(autoSlide, 3000);
