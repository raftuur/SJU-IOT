<?php $pageAction = trim($this->renderSection('page-action')); ?>

<div class="page-header">

    <div class="page-header-left">

        <h1 class="page-title">

            <?= esc($pageTitle ?? 'Dashboard'); ?>

        </h1>

        <p class="page-subtitle">

            <?= esc($pageSubtitle ?? 'Selamat datang di Sistem SJU.'); ?>

        </p>

        <?php if (($pageTitle ?? '') !== 'Dashboard'): ?>

            <?= $this->include('admin/components/breadcrumb'); ?>

        <?php endif; ?>

    </div>

    <?php if ($pageAction !== ''): ?>

        <div class="page-header-right">

            <?= $pageAction ?>

        </div>

    <?php endif; ?>

</div>