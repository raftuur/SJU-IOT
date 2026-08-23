// =====================================================
// TRANSACTION CHART
// =====================================================

const canvas = document.getElementById('transactionChart');

if (canvas) {

    const ctx = canvas.getContext('2d');

    new Chart(ctx, {

        type: 'line',

        data: {

            labels: [
                'Sen',
                'Sel',
                'Rab',
                'Kam',
                'Jum',
                'Sab',
                'Min'
            ],

            datasets: [{

                label: 'Botol',

                data: [
                    25,
                    40,
                    32,
                    55,
                    45,
                    70,
                    60
                ],

                borderColor: '#16A34A',

                backgroundColor: 'rgba(22,163,74,.12)',

                borderWidth: 3,

                fill: true,

                tension: 0.4,

                pointRadius: 4

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {
                    display: true
                }

            },

            scales: {

                y: {

                    beginAtZero: true,

                    title: {

                        display: true,

                        text: 'Jumlah Botol'

                    }

                },

                x: {

                    title: {

                        display: true,

                        text: 'Hari'

                    }

                }

            }

        }

    });

}


// =====================================================
// ADMIN SIDEBAR
// =====================================================

document.addEventListener('DOMContentLoaded', function () {

    const menuToggle = document.querySelector('.menu-toggle');
    const sidebar = document.querySelector('.sidebar');
    const sidebarLinks = document.querySelectorAll('.sidebar-link');

    if (!menuToggle || !sidebar) {
        return;
    }


    // =================================================
    // BUKA / TUTUP SIDEBAR
    // =================================================

    menuToggle.addEventListener('click', function (event) {

        event.stopPropagation();

        sidebar.classList.toggle('active');

    });


    // =================================================
    // KLIK MENU
    // =================================================

    sidebarLinks.forEach(function (link) {

        link.addEventListener('click', function () {

            if (window.innerWidth <= 992) {

                sidebar.classList.remove('active');

            }

        });

    });


    // =================================================
    // KLIK DI LUAR SIDEBAR
    // =================================================

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