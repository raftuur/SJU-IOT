document.addEventListener("DOMContentLoaded", function () {

    // =====================================================
    // MONITORING CHART
    // =====================================================

    const canvas = document.getElementById("monitoringChart");

    if (canvas) {

        new Chart(canvas, {

            type: "line",

            data: {

                labels: [
                    "08:00",
                    "09:00",
                    "10:00",
                    "11:00",
                    "12:00",
                    "13:00",
                    "14:00"
                ],

                datasets: [
                    {
                        label: "Botol",

                        data: [
                            2,
                            5,
                            8,
                            12,
                            15,
                            19,
                            25
                        ],

                        borderWidth: 2,

                        tension: 0.4,

                        fill: false
                    }
                ]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                plugins: {

                    legend: {
                        display: true
                    }

                }

            }

        });

    }


    // =====================================================
    // MOBILE SIDEBAR
    // =====================================================

    const menuToggle = document.querySelector(".menu-toggle");
    const sidebar = document.querySelector(".sidebar");

    if (!menuToggle || !sidebar) {
        return;
    }


    // Buka / tutup sidebar
    menuToggle.addEventListener("click", function (event) {

        event.stopPropagation();

        sidebar.classList.toggle("active");

    });


    // Klik di luar sidebar
    document.addEventListener("click", function (event) {

        if (window.innerWidth > 992) {
            return;
        }

        if (!sidebar.classList.contains("active")) {
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

            sidebar.classList.remove("active");

        }

    });

});