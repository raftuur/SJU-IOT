document.addEventListener('DOMContentLoaded', function () {

    // =====================================================
    // TRANSACTION CHART
    // =====================================================

    const canvas = document.getElementById('transactionChart');

    if (canvas && typeof Chart !== 'undefined') {

        const chartDataElement =
            document.getElementById('dashboardChartData');

        let chartData = [];

        if (chartDataElement) {

            try {

                chartData = JSON.parse(
                    chartDataElement.textContent
                );

            } catch (error) {

                console.error(
                    'Gagal membaca data grafik:',
                    error
                );

            }

        }


        const labels = chartData.map(function (item) {

            const date = new Date(
                item.date + 'T00:00:00'
            );

            return date.toLocaleDateString(
                'id-ID',
                {
                    weekday: 'short'
                }
            );

        });


        const bottleData = chartData.map(function (item) {

            return Number(item.bottle || 0);

        });


        const ctx = canvas.getContext('2d');


        new Chart(ctx, {

            type: 'line',

            data: {

                labels: labels,

                datasets: [{

                    label: 'Botol',

                    data: bottleData,

                    borderColor: '#16A34A',

                    backgroundColor:
                        'rgba(22,163,74,.12)',

                    borderWidth: 3,

                    fill: true,

                    tension: 0.4,

                    pointRadius: 4,

                    pointHoverRadius: 6

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

    const menuToggle =
        document.querySelector('.menu-toggle');

    const sidebar =
        document.querySelector('.sidebar');

    const sidebarLinks =
        document.querySelectorAll('.sidebar-link');


    if (!menuToggle || !sidebar) {
        return;
    }


    // =====================================================
    // BUKA / TUTUP SIDEBAR
    // =====================================================

    menuToggle.addEventListener(
        'click',
        function (event) {

            event.stopPropagation();

            sidebar.classList.toggle('active');

        }
    );


    // =====================================================
    // KLIK MENU
    // =====================================================

    sidebarLinks.forEach(function (link) {

        link.addEventListener(
            'click',
            function () {

                if (window.innerWidth <= 992) {

                    sidebar.classList.remove(
                        'active'
                    );

                }

            }
        );

    });


    // =====================================================
    // KLIK DI LUAR SIDEBAR
    // =====================================================

    document.addEventListener(
        'click',
        function (event) {

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

                sidebar.classList.remove(
                    'active'
                );

            }

        }
    );

});