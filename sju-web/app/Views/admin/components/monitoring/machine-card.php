<div class="card">

    <div class="card-header">

        <h5 class="card-title">

            Daftar Machine

        </h5>

        <span class="badge-custom badge-success">

            Total : <?= $totalMachine; ?> Machine

        </span>

    </div>

    <div class="table-responsive">

        <table class="custom-table">

            <thead>

                <tr>

                    <th width="15%">
                        Kode
                    </th>

                    <th>
                        Nama Machine
                    </th>

                    <th width="25%">
                        Lokasi
                    </th>

                    <th width="140">
                        Status
                    </th>

                    <th width="180">
                        Last Online
                    </th>

                    <th width="180" class="text-center">
                        Monitoring
                    </th>

                </tr>

            </thead>

            <tbody>

                <?php if (!empty($machines)): ?>

                    <?php foreach ($machines as $machine): ?>

                        <tr>

                            <td>

                                <strong>

                                    <?= esc($machine['machine_code']); ?>

                                </strong>

                            </td>

                            <td>

                                <?= esc($machine['machine_name']); ?>

                            </td>

                            <td>

                                <?= esc($machine['location']); ?>

                            </td>

                            <td>

                                <?php if ($machine['realtime_status'] == 'online'): ?>

                                    <span class="badge-custom badge-success">

                                        Online

                                    </span>

                                <?php elseif ($machine['realtime_status'] == 'maintenance'): ?>

                                    <span class="badge-custom badge-warning">

                                        Maintenance

                                    </span>

                                <?php else: ?>

                                    <span class="badge-custom badge-danger">

                                        Offline

                                    </span>

                                <?php endif; ?>

                            </td>

                            <td>

                                <?= $machine['last_online']
                                    ? date('d M Y H:i', strtotime($machine['last_online']))
                                    : '-'; ?>

                            </td>

                            <td class="text-center">

                                <a href="<?= site_url('monitoring/' . $machine['id']); ?>"
                                   class="btn-custom btn-primary-custom">

                                    <i class="bi bi-activity"></i>

                                    Lihat Monitoring

                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td colspan="6">

                            <?= view('admin/components/empty-state', [

                                'title' => 'Belum Ada Machine',

                                'description' => 'Belum ada machine yang terdaftar.',

                                'buttonText' => 'Tambah Machine',

                                'buttonUrl' => site_url('machine/create')

                            ]); ?>

                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>