<div class="machine-detail-panel">

    <!-- HEADER -->
    <div class="machine-detail-header">

        <div class="machine-detail-title">

            <h5>
                <i class="bi bi-cpu"></i>
                <?= esc($machine['machine_name'] ?? 'Detail Machine'); ?>
            </h5>

        </div>

        <a
            href="<?= site_url('user/machine'); ?>"
            class="machine-back-button">

            <i class="bi bi-arrow-left"></i>

            Kembali

        </a>

    </div>


    <!-- BODY -->
    <div class="machine-detail-body">


        <!-- INFORMASI MACHINE -->
        <div class="machine-detail-grid">

            <!-- MACHINE CODE -->
            <div class="machine-detail-item">

                <span class="machine-detail-label">
                    Machine Code
                </span>

                <strong class="machine-detail-value">

                    <?= esc(
                        $machine['machine_code'] ?? '-'
                    ); ?>

                </strong>

            </div>


            <!-- STATUS -->
            <div class="machine-detail-item">

                <span class="machine-detail-label">
                    Status
                </span>

                <?php

                $status = strtolower(
                    $machine['realtime_status']
                    ?? $machine['status']
                    ?? 'offline'
                );

                ?>

                <?php if ($status === 'online'): ?>

                    <span class="machine-detail-status online">

                        <span class="status-dot"></span>

                        <i class="bi bi-check-circle"></i>

                        Online

                    </span>

                <?php elseif ($status === 'maintenance'): ?>

                    <span class="machine-detail-status maintenance">

                        <span class="status-dot"></span>

                        <i class="bi bi-tools"></i>

                        Maintenance

                    </span>

                <?php else: ?>

                    <span class="machine-detail-status offline">

                        <span class="status-dot"></span>

                        <i class="bi bi-x-circle"></i>

                        Offline

                    </span>

                <?php endif; ?>

            </div>


            <!-- LOKASI -->
            <div class="machine-detail-item full">

                <span class="machine-detail-label">
                    Lokasi
                </span>

                <strong class="machine-detail-value location">

                    <i class="bi bi-geo-alt-fill"></i>

                    <?= esc(
                        $machine['location'] ?? '-'
                    ); ?>

                </strong>

            </div>


            <!-- ONLINE TERAKHIR -->
            <div class="machine-detail-item">

                <span class="machine-detail-label">
                    Online Terakhir
                </span>

                <strong class="machine-detail-value">

                    <i class="bi bi-clock"></i>

                    <?= !empty($machine['last_online'])
                        ? date(
                            'd M Y H:i',
                            strtotime(
                                $machine['last_online']
                            )
                        )
                        : '-'; ?>

                </strong>

            </div>


            <!-- FIRMWARE -->
            <div class="machine-detail-item">

                <span class="machine-detail-label">
                    Firmware
                </span>

                <strong class="machine-detail-value">

                    <?= esc(
                        $machine['firmware_version'] ?? '-'
                    ); ?>

                </strong>

            </div>

        </div>


        <!-- KONDISI MACHINE -->

        <div class="machine-condition-section">

            <div class="machine-section-title">

                <h5>

                    <i class="bi bi-speedometer2"></i>

                    Kondisi Machine

                </h5>

            </div>


            <div class="machine-condition-grid">


                <!-- BERAT -->
                <div class="machine-condition-card">

                    <span class="machine-condition-label">
                        Berat Saat Ini
                    </span>

                    <strong class="machine-condition-value">

                        <?= number_format(
                            $machine['sensor']['weight'] ?? 0,
                            2
                        ); ?>

                        <small>Kg</small>

                    </strong>

                </div>


                <!-- BIN -->
                <div class="machine-condition-card">

                    <span class="machine-condition-label">
                        Kapasitas Bin
                    </span>

                    <strong class="machine-condition-value">

                        <?= number_format(
                            $machine['sensor']['bin_level'] ?? 0
                        ); ?>

                        <small>%</small>

                    </strong>

                </div>


                <!-- SUHU -->
                <div class="machine-condition-card">

                    <span class="machine-condition-label">
                        Suhu
                    </span>

                    <strong class="machine-condition-value">

                        <?= number_format(
                            $machine['sensor']['temperature'] ?? 0,
                            1
                        ); ?>

                        <small>°C</small>

                    </strong>

                </div>


                <!-- WIFI RSSI -->
                <div class="machine-condition-card">

                    <span class="machine-condition-label">
                        WiFi RSSI
                    </span>

                    <strong class="machine-condition-value">

                        <?= number_format(
                            $machine['sensor']['wifi_rssi'] ?? 0
                        ); ?>

                        <small>dBm</small>

                    </strong>

                </div>


                <!-- TEGANGAN -->
                <div class="machine-condition-card">

                    <span class="machine-condition-label">
                        Tegangan
                    </span>

                    <strong class="machine-condition-value">

                        <?= number_format(
                            $machine['sensor']['voltage'] ?? 0,
                            2
                        ); ?>

                        <small>V</small>

                    </strong>

                </div>


                <!-- FIRMWARE -->
                <div class="machine-condition-card">

                    <span class="machine-condition-label">
                        Firmware
                    </span>

                    <strong class="machine-condition-value">

                        <?= esc(
                            $machine['firmware_version'] ?? '-'
                        ); ?>

                    </strong>

                </div>


            </div>

        </div>


        <!-- GOOGLE MAPS -->

        <?php if (
            !empty($machine['latitude']) &&
            !empty($machine['longitude'])
        ): ?>

            <div class="machine-detail-map">

                <a
                    href="https://www.google.com/maps?q=<?= esc($machine['latitude']); ?>,<?= esc($machine['longitude']); ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="machine-map-button">

                    <i class="bi bi-geo-alt-fill"></i>

                    Buka di Google Maps

                    <i class="bi bi-box-arrow-up-right"></i>

                </a>

            </div>

        <?php endif; ?>


        <!-- ACTION -->

        <div class="machine-detail-actions">

            <?php if ($status === 'online'): ?>

                <a
                    href="<?= site_url(
                        'user/machine/' .
                        $machine['id'] .
                        '/use'
                    ); ?>"
                    class="machine-use-button">

                    <i class="bi bi-recycle"></i>

                    Gunakan Machine

                </a>

            <?php elseif ($status === 'maintenance'): ?>

                <button
                    type="button"
                    class="machine-disabled-button"
                    disabled>

                    <i class="bi bi-tools"></i>

                    Machine Maintenance

                </button>

            <?php else: ?>

                <button
                    type="button"
                    class="machine-disabled-button"
                    disabled>

                    <i class="bi bi-x-circle"></i>

                    Machine Offline

                </button>

            <?php endif; ?>

        </div>


    </div>

</div>