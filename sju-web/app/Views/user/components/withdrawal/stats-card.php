<div class="stats-grid">

    <div class="stats-card">

        <div class="stats-icon">

            <i class="bi bi-cash-stack"></i>

        </div>

        <div class="stats-title">

            Total Withdrawal

        </div>

        <div class="stats-value">

            <?= count($withdrawals); ?>

        </div>

        <div class="stats-footer">

            Semua pengajuan

        </div>

    </div>

    <div class="stats-card">

        <div class="stats-icon">

            <i class="bi bi-hourglass-split"></i>

        </div>

        <div class="stats-title">

            Pending

        </div>

        <div class="stats-value">

            <?= count(array_filter($withdrawals, fn($w) => $w['status'] === 'pending')); ?>

        </div>

        <div class="stats-footer">

            Menunggu diproses

        </div>

    </div>

    <div class="stats-card">

        <div class="stats-icon">

            <i class="bi bi-arrow-repeat"></i>

        </div>

        <div class="stats-title">

            Processing

        </div>

        <div class="stats-value">

            <?= count(array_filter($withdrawals, fn($w) => $w['status'] === 'processing')); ?>

        </div>

        <div class="stats-footer">

            Sedang diproses

        </div>

    </div>

    <div class="stats-card">

        <div class="stats-icon">

            <i class="bi bi-check-circle"></i>

        </div>

        <div class="stats-title">

            Completed

        </div>

        <div class="stats-value">

            <?= count(array_filter($withdrawals, fn($w) => $w['status'] === 'completed')); ?>

        </div>

        <div class="stats-footer">

            Withdrawal berhasil

        </div>

    </div>

</div>