<div class="dashboard-panel">

    <div class="panel-header">

        <h5>
            Grafik Penukaran Botol
        </h5>

    </div>

    <div class="panel-body">

        <canvas id="transactionChart"></canvas>

        <script
            type="application/json"
            id="dashboardChartData">
            <?= json_encode($chartData ?? []); ?>
        </script>

    </div>

</div>