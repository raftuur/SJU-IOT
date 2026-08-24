<div class="card h-100">

    <div class="card-body text-center">

        <form
            action="<?= site_url('user/profile/avatar'); ?>"
            method="post"
            enctype="multipart/form-data">

            <?= csrf_field(); ?>

            <div class="profile-avatar-wrapper">

                <?php if (!empty($user['avatar'])): ?>

                    <img
                        src="<?= base_url('uploads/avatar/' . $user['avatar']); ?>"
                        alt="Avatar"
                        class="profile-avatar-image"
                        id="profileAvatarPreview">

                <?php else: ?>

                    <div
                        class="profile-avatar-placeholder"
                        id="profileAvatarPreview">

                        <?= strtoupper(
                            substr(
                                $user['fullname'] ?? 'U',
                                0,
                                1
                            )
                        ); ?>

                    </div>

                <?php endif; ?>


                <input
                    type="file"
                    id="avatarInput"
                    name="avatar"
                    accept="image/jpeg,image/png,image/webp"
                    hidden>


                <button
                    type="button"
                    class="profile-avatar-edit"
                    id="avatarButton"
                    title="Ganti Avatar">

                    <i class="bi bi-camera"></i>

                </button>

            </div>

        </form>

        <h5>
            <?= esc($user['fullname'] ?? 'User'); ?>
        </h5>

        <p class="text-muted mb-4">
            <?= esc($user['email'] ?? '-'); ?>
        </p>

        <div class="text-start">

            <div class="mb-3">

                <small class="text-muted">
                    Username
                </small>

                <div>
                    <?= esc($user['username'] ?? '-'); ?>
                </div>

            </div>

            <div class="mb-3">

                <small class="text-muted">
                    Nomor Telepon
                </small>

                <div>
                    <?= esc($user['phone'] ?? '-'); ?>
                </div>

            </div>

            <div>

                <small class="text-muted">
                    Role
                </small>

                <div>

                    <span class="badge bg-success">
                        User
                    </span>

                </div>

            </div>

        </div>

    </div>

</div>