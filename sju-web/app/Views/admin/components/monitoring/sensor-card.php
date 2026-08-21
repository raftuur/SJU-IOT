<div class="card h-100">

    <div class="card-header">

        <h5 class="card-title">
            Sensor Machine
        </h5>

    </div>

    <div class="card-body">

        <table class="table table-borderless align-middle mb-0">

            <tr>
                <td>Kapasitas Bin</td>

                <td class="text-end">
                    <strong>
                        <?= esc($machine['sensor']['bin_level'] ?? 0); ?>%
                    </strong>
                </td>
            </tr>

            <tr>
                <td>Berat Saat Ini</td>

                <td class="text-end">
                    <strong>
                        <?= number_format(
                            $machine['sensor']['weight'] ?? 0,
                            2
                        ); ?> Kg
                    </strong>
                </td>
            </tr>

            <tr>
                <td>Temperature</td>

                <td class="text-end">
                    <strong>
                        <?= number_format(
                            $machine['sensor']['temperature'] ?? 0,
                            1
                        ); ?> °C
                    </strong>
                </td>
            </tr>

            <tr>
                <td>Voltage</td>

                <td class="text-end">
                    <strong>
                        <?= number_format(
                            $machine['sensor']['voltage'] ?? 0,
                            2
                        ); ?> V
                    </strong>
                </td>
            </tr>

            <tr>
                <td>Firmware</td>

                <td class="text-end">
                    <strong>
                        <?= esc($machine['firmware_version'] ?? '-'); ?>
                    </strong>
                </td>
            </tr>

            <tr>
                <td>IP Address</td>

                <td class="text-end">
                    <strong>
                        <?= esc($machine['ip_address'] ?? '-'); ?>
                    </strong>
                </td>
            </tr>

            <tr>
                <td>WiFi RSSI</td>

                <td class="text-end">
                    <strong>
                        <?= esc($machine['sensor']['wifi_rssi'] ?? 0); ?> dBm
                    </strong>
                </td>
            </tr>

            <tr>
                <td>ESP32</td>

                <td class="text-end">

                    <?php if (($machine['realtime_status'] ?? 'offline') === 'online'): ?>

                        <span class="badge-custom badge-success">
                            Connected
                        </span>

                    <?php elseif (($machine['realtime_status'] ?? '') === 'maintenance'): ?>

                        <span class="badge-custom badge-warning">
                            Maintenance
                        </span>

                    <?php else: ?>

                        <span class="badge-custom badge-danger">
                            Disconnected
                        </span>

                    <?php endif; ?>

                </td>
            </tr>

        </table>

    </div>

</div>