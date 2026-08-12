<div class="dashboard-panel">

    <div class="panel-header d-flex justify-content-between align-items-center">

        <h5>

            <i class="bi bi-qr-code me-2"></i>

            QR Code Saya

        </h5>

        <a href="<?= site_url('user/qrcode') ?>" class="btn btn-success btn-sm">

            Buka

        </a>

    </div>

    <div class="panel-body">

        <div class="text-center">

            <?php if (!empty($qrCode)) : ?>

                <img
                    src="<?= $qrCode ?>"
                    class="img-fluid"
                    style="max-width:220px;">

            <?php else : ?>

                <div class="mb-4">

                    <i class="bi bi-qr-code display-1 text-success"></i>

                </div>

                <h6>

                    QR Code Belum Tersedia

                </h6>

                <p class="text-muted">

                    QR Code akan digunakan untuk mengaktifkan mesin Reverse Vending Machine.

                </p>

            <?php endif; ?>

        </div>

    </div>

</div>