<div class="withdrawal-stats">

    <div class="stats-card">

        <div class="stats-icon">
            <i class="bi bi-cash-stack"></i>
        </div>

        <div class="stats-title">
            Total Withdrawal
        </div>

        <div class="stats-value">
            <?= number_format($totalWithdrawal ?? 0); ?>
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
            <?= number_format($pendingWithdrawal ?? 0); ?>
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
            <?= number_format($processingWithdrawal ?? 0); ?>
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
            <?= number_format($completedWithdrawal ?? 0); ?>
        </div>

        <div class="stats-footer">
            Withdrawal berhasil
        </div>

    </div>

</div>