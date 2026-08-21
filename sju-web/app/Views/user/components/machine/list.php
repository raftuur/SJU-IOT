<div class="row g-4">

    <?php if (!empty($machines)): ?>

        <?php foreach ($machines as $machine): ?>

            <?php

                $badgeClass = 'secondary';
                $statusText = '';

                if (!empty($machine['is_in_use'])) {
                    $badgeClass = 'info';
                    $statusText = 'Mesin sedang digunakan.';
                } else {
                    switch ($machine['status']) {
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

                    <div class="panel-header d-flex justify-content-between align-items-center">

                        <h5 class="mb-0">

                            <i class="bi bi-cpu me-2"></i>

                            <?= esc($machine['machine_name']); ?>

                        </h5>

                        <span class="badge bg-<?= $badgeClass; ?>">

                            <?php if (!empty($machine['is_in_use'])): ?>
                                Digunakan
                            <?php else: ?>
                                <?= ucfirst($machine['status']); ?>
                            <?php endif; ?>

                        </span>

                    </div>

                    <div class="panel-body">

                        <div class="mb-3">

                            <small class="text-muted d-block">

                                Machine Code

                            </small>

                            <strong>

                                <?= esc($machine['machine_code']); ?>

                            </strong>

                        </div>

                        <div class="mb-3">

                            <small class="text-muted d-block">

                                Lokasi

                            </small>

                            <?= esc($machine['location']); ?>

                        </div>

                        <div class="mb-4">

                            <small class="text-muted d-block">

                                Status

                            </small>

                            <?= $statusText; ?>

                        </div>

                        <div class="d-flex justify-content-between align-items-center">

                            <small class="text-muted">

                                <?php if (!empty($machine['last_online'])): ?>

                                    Online terakhir

                                    <?= date('d M Y H:i', strtotime($machine['last_online'])); ?>

                                <?php else: ?>

                                    Belum pernah online

                                <?php endif; ?>

                            </small>

                            <div class="d-flex gap-2">

                                <a href="<?= site_url('user/machine/' . $machine['id']); ?>"
                                   class="btn btn-primary">

                                    <i class="bi bi-eye me-1"></i>

                                    Lihat Detail

                                </a>

                                <?php if (
                                    $machine['status'] === 'online'
                                    && empty($machine['is_in_use'])
                                ): ?>

                                    <a href="<?= site_url('user/machine/' . $machine['id'] . '/use'); ?>"
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

            <?= view('admin/components/empty-state', [

                'title'       => 'Belum Ada Machine',

                'description' => 'Belum ada machine yang terdaftar.'

            ]); ?>

        </div>

    <?php endif; ?>

</div>