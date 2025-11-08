document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.getElementById('menuToggle');
    const mainMenu = document.getElementById('mainMenu');

    menuToggle.addEventListener('click', function () {
        mainMenu.classList.toggle('active');
        menuToggle.classList.toggle('active');
    });

    // Cerrar menú al hacer clic en un enlace (en móviles)
    const menuLinks = mainMenu.querySelectorAll('a');
    menuLinks.forEach(link => {
        link.addEventListener('click', function () {
            if (window.innerWidth < 768) {
                mainMenu.classList.remove('active');
                menuToggle.classList.remove('active');
            }
        });
    });

    // Cerrar menú al redimensionar la ventana si se hace más grande
    window.addEventListener('resize', function () {
        if (window.innerWidth >= 768) {
            mainMenu.classList.remove('active');
            menuToggle.classList.remove('active');
        }
    });
});