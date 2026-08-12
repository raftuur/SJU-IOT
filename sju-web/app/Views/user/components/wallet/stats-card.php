<div class="row g-4 mb-4">

    <div class="col-lg-4 col-md-6">

        <div class="stats-card">

            <div class="stats-icon bg-success">

                <i class="bi bi-wallet2"></i>

            </div>

            <div class="stats-content">

                <h3>

                    Rp <?= number_format($wallet['balance'] ?? 0, 0, ',', '.') ?>

                </h3>

                <p>

                    Saldo Saat Ini

                </p>

            </div>

        </div>

    </div>

    <div class="col-lg-4 col-md-6">

        <div class="stats-card">

            <div class="stats-icon bg-primary">

                <i class="bi bi-arrow-down-circle"></i>

            </div>

            <div class="stats-content">

                <h3>

                    <?= number_format($wallet['total_earned'] ?? 0, 0, ',', '.') ?>

                </h3>

                <p>

                    Total Point Masuk

                </p>

            </div>

        </div>

    </div>

    <div class="col-lg-4 col-md-6">

        <div class="stats-card">

            <div class="stats-icon bg-warning">

                <i class="bi bi-clock-history"></i>

            </div>

            <div class="stats-content">

                <h3>

                    <?= count($histories ?? []) ?>

                </h3>

                <p>

                    Total Riwayat

                </p>

            </div>

        </div>

    </div>

</div>