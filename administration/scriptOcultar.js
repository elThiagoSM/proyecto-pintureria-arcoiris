function showSection(sectionId) {
    // Oculta todas las partes
    const sections = document.querySelectorAll('.section-content');
    sections.forEach(section => section.style.display = 'none');

    // Borra la clase activa de todos los enlaces
    const links = document.querySelectorAll('.sidebar ul li a');
    links.forEach(link => link.classList.remove('active'));

    // Muestra la parte elejida
    document.getElementById(sectionId).style.display = 'block';

    // Añade la clase activa al enlace seleccionado
    const activeLink = document.querySelector(`.sidebar ul li a[href="#${sectionId}"]`);
    if (activeLink) activeLink.classList.add('active');
}
