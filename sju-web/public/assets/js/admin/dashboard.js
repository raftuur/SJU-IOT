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
// MOBILE SIDEBAR
// =====================================================

document.addEventListener('DOMContentLoaded', function () {

    const menuToggle = document.querySelector('.menu-toggle');
    const sidebar = document.querySelector('.sidebar');

    if (menuToggle && sidebar) {

        menuToggle.addEventListener('click', function () {

            sidebar.classList.toggle('active');

        });

    }

});