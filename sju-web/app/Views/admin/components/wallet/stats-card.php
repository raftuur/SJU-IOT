<div class="stats-grid">

    <div class="stats-card">

        <div class="stats-icon">
            <i class="bi bi-wallet2"></i>
        </div>

        <div class="stats-title">
            Total Wallet
        </div>

        <div class="stats-value">
            <?= count($wallets) ?>
        </div>

        <div class="stats-footer">
            Wallet aktif
        </div>

    </div>

    <div class="stats-card">

        <div class="stats-icon">
            <i class="bi bi-coin"></i>
        </div>

        <div class="stats-title">
            Total Saldo Point
        </div>

        <div class="stats-value">

            <?= number_format(array_sum(array_column($wallets, 'balance')), 0, ',', '.') ?>

        </div>

        <div class="stats-footer">
            Seluruh pengguna
        </div>

    </div>

    <div class="stats-card">

        <div class="stats-icon">
            <i class="bi bi-arrow-down-circle"></i>
        </div>

        <div class="stats-title">
            Total Point Masuk
        </div>

        <div class="stats-value">

            <?= number_format(array_sum(array_column($wallets, 'total_earned')), 0, ',', '.') ?>

        </div>

        <div class="stats-footer">
            Akumulasi sistem
        </div>

    </div>

    <div class="stats-card">

        <div class="stats-icon">
            <i class="bi bi-arrow-up-circle"></i>
        </div>

        <div class="stats-title">
            Total Point Ditukar
        </div>

        <div class="stats-value">

            <?= number_format(array_sum(array_column($wallets, 'total_redeemed')), 0, ',', '.') ?>

        </div>

        <div class="stats-footer">
            Redeem pengguna
        </div>

    </div>

</div>