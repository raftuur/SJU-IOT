<div class="row g-4 mt-1">

    <!-- MACHINE ONLINE -->
    <div class="col-xl-3 col-md-6">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">
                            Machine Online
                        </small>

                        <h3 class="fw-bold mt-2 mb-0">

                            <?= ($machine['realtime_status'] ?? 'offline') === 'online'
                                ? 1
                                : 0; ?>

                        </h3>

                    </div>

                    <i class="bi bi-hdd-network fs-1 text-success"></i>

                </div>

            </div>

        </div>

    </div>


    <!-- BOTOL HARI INI -->
    <div class="col-xl-3 col-md-6">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">
                            Botol Hari Ini
                        </small>

                        <h3 class="fw-bold mt-2 mb-0">

                            <?= $machine['bottle_today'] ?? 0; ?>

                        </h3>

                    </div>

                    <i class="bi bi-recycle fs-1 text-primary"></i>

                </div>

            </div>

        </div>

    </div>


    <!-- BERAT HARI INI -->
    <div class="col-xl-3 col-md-6">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">
                            Berat Hari Ini
                        </small>

                        <h3 class="fw-bold mt-2 mb-0">

                            <?= number_format(
                                $machine['weight_today'] ?? 0,
                                2
                            ); ?> Kg

                        </h3>

                    </div>

                    <i class="bi bi-speedometer2 fs-1 text-warning"></i>

                </div>

            </div>

        </div>

    </div>


    <!-- POINT HARI INI -->
    <div class="col-xl-3 col-md-6">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">
                            Point Hari Ini
                        </small>

                        <h3 class="fw-bold mt-2 mb-0">

                            <?= $machine['point_today'] ?? 0; ?>

                        </h3>

                    </div>

                    <i class="bi bi-coin fs-1 text-danger"></i>

                </div>

            </div>

        </div>

    </div>

</div>