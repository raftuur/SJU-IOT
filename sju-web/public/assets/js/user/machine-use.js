document.addEventListener('DOMContentLoaded', () => {

    const statusContainer = document.getElementById('scanStatus');
    const sessionStatusUrl = document.getElementById('sessionStatusUrl');

    if (!statusContainer || !sessionStatusUrl) {
        return;
    }

    const statusUrl = sessionStatusUrl.value;

    let checking = true;


    function showWaiting() {

        statusContainer.innerHTML = `
            <div class="spinner-border text-success"
                 role="status">
            </div>

            <p class="mt-3 mb-0">
                Menunggu QR Code dipindai...
            </p>

            <small class="text-muted">
                Arahkan QR Code ke kamera ESP32-CAM.
            </small>
        `;
    }


    function showSuccess(session) {

        statusContainer.innerHTML = `
            <div class="mb-3">

                <i class="bi bi-check-circle-fill text-success"
                   style="font-size:64px;">
                </i>

            </div>

            <h5 class="text-success">
                QR Code Berhasil Diverifikasi
            </h5>

            <p class="text-muted mb-2">
                Session machine berhasil dimulai.
            </p>

            <span class="badge bg-success">
                Session Aktif
            </span>
        `;

        if (session) {

            if (session.session_token) {

                sessionStorage.setItem(
                    'machine_session_token',
                    session.session_token
                );
            }

            if (session.id) {

                sessionStorage.setItem(
                    'machine_session_id',
                    session.id
                );
            }
        }

        checking = false;
    }


    function showError(message) {

        statusContainer.innerHTML = `
            <div class="mb-3">

                <i class="bi bi-exclamation-circle-fill text-danger"
                   style="font-size:48px;">
                </i>

            </div>

            <h5 class="text-danger">
                Gagal Memeriksa Session
            </h5>

            <p class="text-muted mb-0">
                ${message}
            </p>
        `;
    }


    async function checkSession() {

        if (!checking) {
            return;
        }

        try {

            const response = await fetch(statusUrl, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json'
                },
                cache: 'no-store'
            });


            if (!response.ok) {

                throw new Error(
                    'Gagal menghubungi server.'
                );
            }


            const data = await response.json();


            if (
                data.success === true &&
                data.session_active === true &&
                data.session
            ) {

                showSuccess(data.session);

                return;
            }


            showWaiting();

        } catch (error) {

            console.error(
                'Session check error:',
                error
            );

        }

    }


    showWaiting();

    checkSession();

    setInterval(
        checkSession,
        2000
    );

});