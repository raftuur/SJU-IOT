<div class="stats-grid">

    <div class="stats-card">

        <div class="stats-icon">

            <i class="bi bi-gift"></i>

        </div>

        <div class="stats-title">

            Total Penukaran

        </div>

        <div class="stats-value">

            <?= count($rewards); ?>

        </div>

        <div class="stats-footer">

            Semua penukaran

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

            <?= count(array_filter($rewards, fn($r) => $r['status'] === 'pending')); ?>

        </div>

        <div class="stats-footer">

            Menunggu verifikasi

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

            <?= count(array_filter($rewards, fn($r) => $r['status'] === 'completed')); ?>

        </div>

        <div class="stats-footer">

            Berhasil ditukar

        </div>

    </div>

    <div class="stats-card">

        <div class="stats-icon">

            <i class="bi bi-x-circle"></i>

        </div>

        <div class="stats-title">

            Rejected

        </div>

        <div class="stats-value">

            <?= count(array_filter($rewards, fn($r) => $r['status'] === 'rejected')); ?>

        </div>

        <div class="stats-footer">

            Ditolak admin

        </div>

    </div>

</div>