<div class="dashboard-panel">

    <div class="panel-header sensor-panel-header">

        <h5>
            <i class="bi bi-activity me-2"></i>
            Monitoring Sensor
        </h5>

        <form
            method="get"
            action="<?= site_url('dashboard'); ?>"
            class="sensor-machine-form">

            <select
                name="machine_id"
                class="sensor-machine-select"
                onchange="this.form.submit()">

                <?php foreach ($machines ?? [] as $machine): ?>

                    <option
                        value="<?= esc($machine['id']); ?>"
                        <?= !empty($selectedMachine)
                            && $selectedMachine['id'] == $machine['id']
                            ? 'selected'
                            : ''; ?>>

                        <?= esc($machine['machine_code']); ?>
                        -
                        <?= esc($machine['machine_name']); ?>

                    </option>

                <?php endforeach; ?>

            </select>

        </form>

    </div>


    <div class="panel-body">

        <?php if (!empty($selectedMachine)): ?>

            <div class="sensor-machine-name">

                <i class="bi bi-cpu me-1"></i>

                <?= esc($selectedMachine['machine_name']); ?>

            </div>

        <?php endif; ?>


        <div class="sensor-grid">


            <!-- Berat -->

            <div class="sensor-card">

                <i class="bi bi-speedometer2"></i>

                <div>

                    <small>
                        Berat Terakhir
                    </small>

                    <h4>

                        <?= !empty($latestSensor)
                            ? number_format(
                                (float) $latestSensor['weight'],
                                0,
                                ',',
                                '.'
                            ) . ' gram'
                            : '0 gram'; ?>

                    </h4>

                </div>

            </div>


            <!-- Total Botol -->

            <div class="sensor-card">

                <i class="bi bi-recycle"></i>

                <div>

                    <small>
                        Total Botol
                    </small>

                    <h4>
                        <?= number_format(
                            $totalBottle ?? 0,
                            0,
                            ',',
                            '.'
                        ); ?>
                    </h4>

                </div>

            </div>


            <!-- Suhu -->

            <div class="sensor-card">

                <i class="bi bi-thermometer-half"></i>

                <div>

                    <small>
                        Suhu
                    </small>

                    <h4>

                        <?= !empty($latestSensor)
                            && $latestSensor['temperature'] !== null
                            ? number_format(
                                (float) $latestSensor['temperature'],
                                1,
                                ',',
                                '.'
                            ) . ' °C'
                            : '- °C'; ?>

                    </h4>

                </div>

            </div>


            <!-- WiFi -->

            <div class="sensor-card">

                <i class="bi bi-wifi"></i>

                <div>

                    <small>
                        WiFi RSSI
                    </small>

                    <h4>

                        <?= !empty($latestSensor)
                            && $latestSensor['wifi_rssi'] !== null
                            ? $latestSensor['wifi_rssi'] . ' dBm'
                            : '- dBm'; ?>

                    </h4>

                </div>

            </div>


        </div>

    </div>

</div>