<div class="row g-4 mb-4">

    <div class="col-lg-3 col-md-6">

        <div class="stats-card">

            <div class="stats-icon bg-primary">

                <i class="bi bi-ticket-perforated"></i>

            </div>

            <div class="stats-content">

                <h3>

                    <?= count($redemptions); ?>

                </h3>

                <p>

                    Total Redemption

                </p>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6">

        <div class="stats-card">

            <div class="stats-icon bg-warning">

                <i class="bi bi-hourglass-split"></i>

            </div>

            <div class="stats-content">

                <h3>

                    <?= count(array_filter($redemptions, fn($r) => $r['status'] === 'pending')); ?>

                </h3>

                <p>

                    Pending

                </p>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6">

        <div class="stats-card">

            <div class="stats-icon bg-success">

                <i class="bi bi-check-circle"></i>

            </div>

            <div class="stats-content">

                <h3>

                    <?= count(array_filter($redemptions, fn($r) => $r['status'] === 'completed')); ?>

                </h3>

                <p>

                    Completed

                </p>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6">

        <div class="stats-card">

            <div class="stats-icon bg-danger">

                <i class="bi bi-x-circle"></i>

            </div>

            <div class="stats-content">

                <h3>

                    <?= count(array_filter($redemptions, fn($r) => $r['status'] === 'rejected')); ?>

                </h3>

                <p>

                    Rejected

                </p>

            </div>

        </div>

    </div>

</div>