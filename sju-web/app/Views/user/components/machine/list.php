<div class="row g-4">

    <?php if (!empty($machines)): ?>

        <?php foreach ($machines as $machine): ?>

            <?php

            // Gunakan status realtime dari MonitoringService
            $realtimeStatus = strtolower(
                $machine['realtime_status']
                ?? $machine['status']
                ?? 'offline'
            );

            $badgeClass = 'danger';
            $statusText = 'Mesin sedang tidak tersedia.';

            if (!empty($machine['is_in_use'])) {

                $badgeClass = 'info';
                $statusText = 'Mesin sedang digunakan.';

            } else {

                switch ($realtimeStatus) {

                    case 'online':

                        $badgeClass = 'success';
                        $statusText = 'Mesin siap digunakan.';

                        break;

                    case 'maintenance':

                        $badgeClass = 'warning';
                        $statusText = 'Mesin sedang dalam perbaikan.';

                        break;

                    default:

                        $badgeClass = 'danger';
                        $statusText = 'Mesin sedang tidak tersedia.';

                        break;
                }
            }

            ?>


            <div class="col-lg-6">

                <div class="dashboard-panel h-100">


                    <!-- HEADER -->

                    <div class="panel-header d-flex justify-content-between align-items-center">

                        <h5 class="mb-0">

                            <i class="bi bi-cpu me-2"></i>

                            <?= esc(
                                $machine['machine_name'] ?? '-'
                            ); ?>

                        </h5>


                        <span class="badge bg-<?= $badgeClass; ?>">

                            <?php if (!empty($machine['is_in_use'])): ?>

                                Digunakan

                            <?php else: ?>

                                <?= ucfirst(
                                    $realtimeStatus
                                ); ?>

                            <?php endif; ?>

                        </span>

                    </div>


                    <!-- BODY -->

                    <div class="panel-body">


                        <!-- MACHINE CODE -->

                        <div class="mb-3">

                            <small class="text-muted d-block">

                                Machine Code

                            </small>

                            <strong>

                                <?= esc(
                                    $machine['machine_code'] ?? '-'
                                ); ?>

                            </strong>

                        </div>


                        <!-- LOKASI -->

                        <div class="mb-3">

                            <small class="text-muted d-block">

                                Lokasi

                            </small>

                            <?= esc(
                                $machine['location'] ?? '-'
                            ); ?>

                        </div>


                        <!-- STATUS -->

                        <div class="mb-4">

                            <small class="text-muted d-block">

                                Status

                            </small>

                            <?= esc($statusText); ?>

                        </div>


                        <!-- FOOTER -->

                        <div class="d-flex justify-content-between align-items-center">


                            <!-- LAST ONLINE -->

                            <small class="text-muted">

                                <?php if (
                                    !empty($machine['last_online'])
                                ): ?>

                                    Online terakhir

                                    <?= date(
                                        'd M Y H:i',
                                        strtotime(
                                            $machine['last_online']
                                        )
                                    ); ?>

                                <?php else: ?>

                                    Belum pernah online

                                <?php endif; ?>

                            </small>


                            <!-- ACTION -->

                            <div class="d-flex gap-2">


                                <!-- DETAIL -->

                                <a
                                    href="<?= site_url(
                                        'user/machine/' .
                                        $machine['id']
                                    ); ?>"
                                    class="btn btn-primary">

                                    <i class="bi bi-eye me-1"></i>

                                    Lihat Detail

                                </a>


                                <!-- USE -->

                                <?php if (
                                    $realtimeStatus === 'online'
                                    && empty($machine['is_in_use'])
                                ): ?>

                                    <a
                                        href="<?= site_url(
                                            'user/machine/' .
                                            $machine['id'] .
                                            '/use'
                                        ); ?>"
                                        class="btn btn-success">

                                        <i class="bi bi-play-circle me-1"></i>

                                        Gunakan Mesin

                                    </a>

                                <?php endif; ?>


                            </div>

                        </div>


                    </div>

                </div>

            </div>


        <?php endforeach; ?>


    <?php else: ?>


        <div class="col-12">

            <?= view(
                'admin/components/empty-state',
                [
                    'title' =>
                        'Belum Ada Machine',

                    'description' =>
                        'Belum ada machine yang terdaftar.'
                ]
            ); ?>

        </div>


    <?php endif; ?>

</div>