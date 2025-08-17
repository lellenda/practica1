const toggleBtn = document.querySelector(".toggle");
const navLinks = document.querySelector(".nav-links");

toggleBtn.addEventListener("click", () => {
  if (navLinks.style.display === "block") {
    navLinks.style.display = "none";
    toggleBtn.textContent = "☰";
  } else {
    navLinks.style.display = "block";
    toggleBtn.textContent = "✖";
  }
});

// Para que el menú esté visible en pantallas grandes
window.addEventListener('resize', () => {
  if(window.innerWidth > 768) {
    navLinks.style.display = "block";
    toggleBtn.textContent = "✖";
  } else {
    navLinks.style.display = "none";
    toggleBtn.textContent = "☰";
  }
});
// Inicializa el menú correcto según el tamaño de pantalla al cargar
window.addEventListener('load', () => {
  if(window.innerWidth > 768) {
    navLinks.style.display = "block";
    toggleBtn.textContent = "✖";
  } else {
    navLinks.style.display = "none";
    toggleBtn.textContent = "☰";
  }
});
