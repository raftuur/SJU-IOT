<nav class="navbar-custom">

    <div class="navbar-left">

        <button type="button" class="menu-toggle">

            <i class="bi bi-list"></i>

        </button>

    </div>

    <div class="navbar-right">

        <button type="button" class="navbar-icon">

            <i class="bi bi-bell"></i>

        </button>

        <div class="navbar-user">

            <div class="navbar-avatar">

                <?= strtoupper(substr(session('fullname'), 0, 1)); ?>

            </div>

            <div class="navbar-user-info">

                <span class="navbar-user-name">

                    <?= esc(session('fullname')); ?>

                </span>

                <span class="navbar-user-role">

                    <?= ucfirst(session('role')); ?>

                </span>

            </div>

        </div>

    </div>

</nav>