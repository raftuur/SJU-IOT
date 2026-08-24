document.addEventListener('DOMContentLoaded', function () {

    const menuToggle = document.querySelector('.menu-toggle');
    const sidebar = document.querySelector('.sidebar');

    if (!menuToggle || !sidebar) {
        return;
    }


    // Buka / tutup sidebar
    menuToggle.addEventListener('click', function (event) {

        event.stopPropagation();

        sidebar.classList.toggle('active');

    });


    // Klik di luar sidebar
    document.addEventListener('click', function (event) {

        if (window.innerWidth > 992) {
            return;
        }

        if (!sidebar.classList.contains('active')) {
            return;
        }

        const clickedInsideSidebar =
            sidebar.contains(event.target);

        const clickedMenuToggle =
            menuToggle.contains(event.target);

        if (
            !clickedInsideSidebar &&
            !clickedMenuToggle
        ) {
            sidebar.classList.remove('active');
        }

    });

});