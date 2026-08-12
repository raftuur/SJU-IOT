<div class="empty-state">

    <div class="empty-icon">

        <i class="bi bi-folder2-open"></i>

    </div>

    <h4 class="empty-title">

        <?= esc($title ?? 'Belum Ada Data'); ?>

    </h4>

    <p class="empty-text">

        <?= esc($description ?? 'Data belum tersedia.'); ?>

    </p>

    <?php if (!empty($buttonText)): ?>

        <a
            href="<?= $buttonUrl ?? '#' ?>"
            class="btn-custom btn-primary-custom">

            <i class="bi bi-plus-lg"></i>

            <?= esc($buttonText); ?>

        </a>

    <?php endif; ?>

</div>