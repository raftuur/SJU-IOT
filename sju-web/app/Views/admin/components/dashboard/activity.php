<div class="dashboard-panel">

    <div class="panel-header">

        <h5>
            Aktivitas Terbaru
        </h5>

    </div>

    <div class="panel-body">

        <?php if (!empty($activities)): ?>

            <?php foreach ($activities as $activity): ?>

                <div class="activity-item">

                    <div class="activity-icon <?= esc($activity['color']); ?>">

                        <i class="bi <?= esc($activity['icon']); ?>"></i>

                    </div>

                    <div class="activity-content">

                        <div class="activity-title">

                            <?= esc($activity['title']); ?>

                        </div>

                        <div class="activity-time">

                            <?= esc($activity['description']); ?>

                            ·

                            <?= date(
                                'd/m/Y H:i',
                                strtotime($activity['time'])
                            ); ?>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="dashboard-empty">

                <i class="bi bi-clock-history"></i>

                <p>
                    Belum ada aktivitas terbaru.
                </p>

            </div>

        <?php endif; ?>

    </div>

</div>