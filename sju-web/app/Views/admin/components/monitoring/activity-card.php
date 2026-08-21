<div class="card h-100">

    <div class="card-header">

        <h5 class="card-title">
            Aktivitas Terbaru
        </h5>

    </div>

    <div class="card-body p-0">

        <ul class="list-group list-group-flush">

            <?php if (!empty($activities)): ?>

                <?php foreach ($activities as $activity): ?>

                    <li class="list-group-item">

                        <div class="d-flex justify-content-between gap-3">

                            <span>

                                <?= esc($activity['description']); ?>

                            </span>

                            <small class="text-muted text-nowrap">

                                <?= !empty($activity['created_at'])
                                    ? date(
                                        'H:i',
                                        strtotime($activity['created_at'])
                                    )
                                    : '-'; ?>

                            </small>

                        </div>

                    </li>

                <?php endforeach; ?>

            <?php else: ?>

                <li class="list-group-item text-muted text-center">

                    Belum ada aktivitas.

                </li>

            <?php endif; ?>

        </ul>

    </div>

</div>