document.addEventListener("DOMContentLoaded", function () {

    const canvas = document.getElementById("monitoringChart");

    if (!canvas) {
        return;
    }

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

                    data: [2, 5, 8, 12, 15, 19, 25],

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

});