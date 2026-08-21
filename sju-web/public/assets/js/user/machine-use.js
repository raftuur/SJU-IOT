document.addEventListener('DOMContentLoaded', () => {

    const button = document.getElementById('btnStartSession');
    const status = document.getElementById('sessionStatus');

    if (!button) {
        return;
    }

    button.addEventListener('click', () => {

        button.disabled = true;

        button.innerHTML = `
            <span class="spinner-border spinner-border-sm me-2"></span>
            Menunggu QR...
        `;

        status.style.display = 'block';

        status.innerHTML = `
            <div class="mb-3">
                <i class="bi bi-qr-code-scan text-success"
                   style="font-size: 64px;"></i>
            </div>

            <h5>
                Silakan Scan QR Code
            </h5>

            <p class="text-muted">
                Arahkan QR Code kamu ke kamera
                ESP32-CAM pada mesin.
            </p>

            <div class="alert alert-info mt-3">
                <i class="bi bi-info-circle me-2"></i>
                Jangan masukkan botol sebelum QR berhasil
                diverifikasi oleh mesin.
            </div>
        `;

    });

});