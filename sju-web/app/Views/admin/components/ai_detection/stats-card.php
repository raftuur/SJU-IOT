<div class="row g-4 mb-4">

    <div class="col-xl-3 col-md-6">

        <div class="card-custom stats-card">

            <div class="stats-icon bg-primary">

                <i class="bi bi-camera"></i>

            </div>

            <div class="stats-content">

                <h6>Total Detection</h6>

                <h3><?= esc($statistics['total']); ?></h3>

            </div>

        </div>

    </div>

    <div class="col-xl-3 col-md-6">

        <div class="card-custom stats-card">

            <div class="stats-icon bg-success">

                <i class="bi bi-check-circle"></i>

            </div>

            <div class="stats-content">

                <h6>Valid Detection</h6>

                <h3><?= esc($statistics['valid']); ?></h3>

            </div>

        </div>

    </div>

    <div class="col-xl-3 col-md-6">

        <div class="card-custom stats-card">

            <div class="stats-icon bg-danger">

                <i class="bi bi-x-circle"></i>

            </div>

            <div class="stats-content">

                <h6>Invalid Detection</h6>

                <h3><?= esc($statistics['invalid']); ?></h3>

            </div>

        </div>

    </div>

    <div class="col-xl-3 col-md-6">

        <div class="card-custom stats-card">

            <div class="stats-icon bg-warning">

                <i class="bi bi-graph-up-arrow"></i>

            </div>

            <div class="stats-content">

                <h6>Average Confidence</h6>

                <h3>

                    <?= number_format($statistics['average_confidence'] * 100, 2); ?>%

                </h3>

            </div>

        </div>

    </div>

</div>