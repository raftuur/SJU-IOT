<?php

$current = service('uri')->getSegment(2);

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

        <a href="<?= site_url('user/dashboard'); ?>"
           class="sidebar-link <?= $current === 'dashboard' ? 'active' : ''; ?>">

            <i class="bi bi-speedometer2"></i>

            <span>Dashboard</span>

        </a>

        <a href="<?= site_url('user/qrcode'); ?>"
           class="sidebar-link <?= $current === 'qrcode' ? 'active' : ''; ?>">

            <i class="bi bi-qr-code"></i>

            <span>QR Code</span>

        </a>

        <a href="<?= site_url('user/machine'); ?>"
           class="sidebar-link <?= $current === 'machine' ? 'active' : ''; ?>">

            <i class="bi bi-cpu"></i>

            <span>Machine</span>

        </a>

        <a href="<?= site_url('user/wallet'); ?>"
           class="sidebar-link <?= $current === 'wallet' ? 'active' : ''; ?>">

            <i class="bi bi-wallet2"></i>

            <span>Wallet</span>

        </a>

        <a href="<?= site_url('user/transaction'); ?>"
           class="sidebar-link <?= $current === 'transaction' ? 'active' : ''; ?>">

            <i class="bi bi-receipt"></i>

            <span>Transaction</span>

        </a>

        <a href="<?= site_url('user/voucher'); ?>"
           class="sidebar-link <?= $current === 'voucher' ? 'active' : ''; ?>">

            <i class="bi bi-ticket-perforated"></i>

            <span>Voucher</span>

        </a>

        <a href="<?= site_url('user/reward'); ?>"
           class="sidebar-link <?= $current === 'reward' ? 'active' : ''; ?>">

            <i class="bi bi-gift"></i>

            <span>Reward</span>

        </a>

        <a href="<?= site_url('user/withdrawal'); ?>"
           class="sidebar-link <?= $current === 'withdrawal' ? 'active' : ''; ?>">

            <i class="bi bi-cash-coin"></i>

            <span>Withdrawal</span>

        </a>

        <a href="<?= site_url('user/profile'); ?>"
           class="sidebar-link <?= $current === 'profile' ? 'active' : ''; ?>">

            <i class="bi bi-person-circle"></i>

            <span>Profil</span>

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