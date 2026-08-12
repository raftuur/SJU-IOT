<div class="stats-grid">

    <div class="stats-card">

        <div class="stats-icon">
            <i class="bi bi-wallet2"></i>
        </div>

        <div class="stats-title">
            Total Point
        </div>

        <div class="stats-value">
            <?= number_format($totalPoint ?? 0) ?>
        </div>

        <div class="stats-footer">
            Point yang dapat digunakan
        </div>

    </div>

    <div class="stats-card">

        <div class="stats-icon">
            <i class="bi bi-recycle"></i>
        </div>

        <div class="stats-title">
            Total Botol
        </div>

        <div class="stats-value">
            <?= number_format($totalBottle ?? 0) ?>
        </div>

        <div class="stats-footer">
            Botol berhasil didaur ulang
        </div>

    </div>

    <div class="stats-card">

        <div class="stats-icon">
            <i class="bi bi-arrow-left-right"></i>
        </div>

        <div class="stats-title">
            Total Transaksi
        </div>

        <div class="stats-value">
            <?= number_format($totalTransaction ?? 0) ?>
        </div>

        <div class="stats-footer">
            Seluruh transaksi pengguna
        </div>

    </div>

    <div class="stats-card">

        <div class="stats-icon">
            <i class="bi bi-gift"></i>
        </div>

        <div class="stats-title">
            Reward Ditukar
        </div>

        <div class="stats-value">
            <?= number_format($totalReward ?? 0) ?>
        </div>

        <div class="stats-footer">
            Total reward yang telah ditukar
        </div>

    </div>

</div>