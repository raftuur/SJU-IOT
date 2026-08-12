<div class="stats-grid">

    <div class="stats-card">

        <div class="stats-icon">
            <i class="bi bi-gift"></i>
        </div>

        <div class="stats-title">
            Total Voucher
        </div>

        <div class="stats-value">
            <?= count($vouchers); ?>
        </div>

        <div class="stats-footer">
            Seluruh voucher
        </div>

    </div>

    <div class="stats-card">

        <div class="stats-icon">
            <i class="bi bi-check-circle"></i>
        </div>

        <div class="stats-title">
            Voucher Aktif
        </div>

        <div class="stats-value">
            <?= count(array_filter($vouchers, fn($v) => $v['status'] === 'active')); ?>
        </div>

        <div class="stats-footer">
            Siap ditukar
        </div>

    </div>

    <div class="stats-card">

        <div class="stats-icon">
            <i class="bi bi-box-seam"></i>
        </div>

        <div class="stats-title">
            Total Stok
        </div>

        <div class="stats-value">
            <?= number_format(array_sum(array_column($vouchers, 'stock')), 0, ',', '.'); ?>
        </div>

        <div class="stats-footer">
            Semua voucher
        </div>

    </div>

    <div class="stats-card">

        <div class="stats-icon">
            <i class="bi bi-arrow-repeat"></i>
        </div>

        <div class="stats-title">
            Total Redeem
        </div>

        <div class="stats-value">
            <?= number_format(array_sum(array_column($vouchers, 'redeemed')), 0, ',', '.'); ?>
        </div>

        <div class="stats-footer">
            Voucher ditukar
        </div>

    </div>

</div>