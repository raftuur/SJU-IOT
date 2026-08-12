<?php

$current = service('uri')->getSegment(1);

?>

<aside class="sidebar">

    <!-- BRAND -->
    <div class="sidebar-brand">

        <div class="sidebar-logo">
            SJU
        </div>

        <div class="sidebar-title">
            Sampah Jadi Uang
        </div>

    </div>

    <!-- MENU -->
    <nav class="sidebar-menu">

        <a href="<?= site_url('dashboard'); ?>"
           class="sidebar-link <?= $current === 'dashboard' ? 'active' : ''; ?>">

            <i class="bi bi-speedometer2"></i>

            <span>Dashboard</span>

        </a>

        <a href="<?= site_url('user'); ?>"
           class="sidebar-link <?= $current === 'user' ? 'active' : ''; ?>">

            <i class="bi bi-people"></i>

            <span>User</span>

        </a>

        <a href="<?= site_url('wallet'); ?>"
           class="sidebar-link <?= $current === 'wallet' ? 'active' : ''; ?>">

            <i class="bi bi-wallet2"></i>

            <span>Wallet</span>

        </a>

        <a href="<?= site_url('machine'); ?>"
           class="sidebar-link <?= $current === 'machine' ? 'active' : ''; ?>">

            <i class="bi bi-cpu"></i>

            <span>Machine</span>

        </a>

        <a href="<?= site_url('monitoring'); ?>"
           class="sidebar-link <?= $current === 'monitoring' ? 'active' : ''; ?>">

            <i class="bi bi-graph-up-arrow"></i>

            <span>Monitoring</span>

        </a>

        <a href="<?= site_url('ai-detection'); ?>"
           class="sidebar-link <?= $current === 'ai-detection' ? 'active' : ''; ?>">

            <i class="bi bi-robot"></i>

            <span>AI Detection</span>

        </a>

        <a href="<?= site_url('voucher'); ?>"
           class="sidebar-link <?= $current === 'voucher' ? 'active' : ''; ?>">

            <i class="bi bi-gift"></i>

            <span>Voucher</span>

        </a>

        <a href="<?= site_url('redemption'); ?>"
           class="sidebar-link <?= $current === 'redemption' ? 'active' : ''; ?>">

            <i class="bi bi-ticket-perforated"></i>

            <span>Redemption</span>

        </a>

        <a href="<?= site_url('withdrawal'); ?>"
           class="sidebar-link <?= $current === 'withdrawal' ? 'active' : ''; ?>">

            <i class="bi bi-cash-stack"></i>

            <span>Withdrawal</span>

        </a>

        <a href="<?= site_url('setting'); ?>"
           class="sidebar-link <?= $current === 'setting' ? 'active' : ''; ?>">

            <i class="bi bi-gear"></i>

            <span>Setting</span>

        </a>

    </nav>

    <!-- LOGOUT -->
    <div class="sidebar-profile">

        <form action="<?= site_url('auth/logout'); ?>" method="post">

            <?= csrf_field(); ?>

            <button type="submit" class="sidebar-logout">

                <i class="bi bi-box-arrow-right"></i>

                <span>Logout</span>

            </button>

        </form>

    </div>

</aside>