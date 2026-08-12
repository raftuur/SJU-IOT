<?php

$statusTitle = '';
$statusMessage = '';
$statusClass = '';
$statusIcon = '';

switch ($machine['status']) {

    case 'online':
        $statusTitle   = 'Machine Siap Digunakan';
        $statusMessage = 'Silakan buka menu QR Code kemudian arahkan ke kamera ESP32-CAM untuk memulai proses.';
        $statusClass   = 'success';
        $statusIcon    = 'bi-check-circle-fill';
        break;

    case 'maintenance':
        $statusTitle   = 'Machine Sedang Maintenance';
        $statusMessage = 'Machine sedang dalam proses perbaikan. Silakan gunakan machine lainnya.';
        $statusClass   = 'warning';
        $statusIcon    = 'bi-tools';
        break;

    default:
        $statusTitle   = 'Machine Offline';
        $statusMessage = 'Machine sedang tidak tersedia. Silakan gunakan machine lainnya.';
        $statusClass   = 'danger';
        $statusIcon    = 'bi-x-circle-fill';
        break;
}

?>

<div class="dashboard-panel mb-4">

    <div class="panel-body">

        <div class="d-flex align-items-center">

            <div class="me-3">

                <i class="bi <?= $statusIcon ?> text-<?= $statusClass ?>"
                   style="font-size:48px;"></i>

            </div>

            <div>

                <h4 class="mb-2">

                    <?= $statusTitle ?>

                </h4>

                <p class="text-muted mb-0">

                    <?= $statusMessage ?>

                </p>

            </div>

        </div>

    </div>

</div>