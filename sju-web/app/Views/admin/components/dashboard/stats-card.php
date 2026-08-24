<div class="stats-grid">

    <div class="stats-card">

        <div class="stats-icon">
            <i class="bi bi-people"></i>
        </div>

        <div class="stats-title">
            Total User
        </div>

        <div class="stats-value">
            <?= number_format($totalUser ?? 0, 0, ',', '.'); ?>
        </div>

        <div class="stats-footer">
            Pengguna terdaftar
        </div>

    </div>


    <div class="stats-card">

        <div class="stats-icon">
            <i class="bi bi-cpu"></i>
        </div>

        <div class="stats-title">
            Total Machine
        </div>

        <div class="stats-value">
            <?= number_format($totalMachine ?? 0, 0, ',', '.'); ?>
        </div>

        <div class="stats-footer">
            RVM tersedia
        </div>

    </div>


    <div class="stats-card">

        <div class="stats-icon">
            <i class="bi bi-receipt"></i>
        </div>

        <div class="stats-title">
            Total Transaksi
        </div>

        <div class="stats-value">
            <?= number_format($totalTransaction ?? 0, 0, ',', '.'); ?>
        </div>

        <div class="stats-footer">
            Penukaran botol
        </div>

    </div>


    <div class="stats-card">

        <div class="stats-icon">
            <i class="bi bi-trash"></i>
        </div>

        <div class="stats-title">
            Total Botol
        </div>

        <div class="stats-value">
            <?= number_format($totalBottle ?? 0, 0, ',', '.'); ?>
        </div>

        <div class="stats-footer">
            Botol terkumpul
        </div>

    </div>

</div>