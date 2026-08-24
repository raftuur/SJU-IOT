<?php

use App\Models\UserModel;

$userModel = new UserModel();

$currentUser = null;

if (session()->get('userId')) {
    $currentUser = $userModel->find(
        session()->get('userId')
    );
}

?>

<nav class="navbar-custom">

    <div class="navbar-left">

        <button type="button" class="menu-toggle">

            <i class="bi bi-list"></i>

        </button>

    </div>


    <div class="navbar-right">

        <a
            href="<?= site_url('user/qrcode'); ?>"
            class="navbar-icon"
            title="QR Code Saya">

            <i class="bi bi-qr-code"></i>

        </a>


        <div class="navbar-user">

            <div class="navbar-avatar">

                <?php if (!empty($currentUser['avatar'])): ?>

                    <img
                        src="<?= base_url('uploads/avatar/' . $currentUser['avatar']); ?>"
                        alt="Avatar"
                        class="navbar-avatar-image">

                <?php else: ?>

                    <div class="navbar-avatar-placeholder">

                        <?= strtoupper(
                            substr(
                                $currentUser['fullname']
                                    ?? session('fullname')
                                    ?? 'U',
                                0,
                                1
                            )
                        ); ?>

                    </div>

                <?php endif; ?>

            </div>


            <div class="navbar-user-info">

                <span class="navbar-user-name">

                    <?= esc(
                        $currentUser['fullname']
                            ?? session('fullname')
                            ?? 'User'
                    ); ?>

                </span>

                <span class="navbar-user-role">

                    User

                </span>

            </div>

        </div>

    </div>

</nav>