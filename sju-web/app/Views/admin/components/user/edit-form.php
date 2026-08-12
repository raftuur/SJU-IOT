<div class="card">

    <div class="card-header">

        <div>

            <h5 class="card-title">
                Edit User
            </h5>

            <p class="card-subtitle">
                Perbarui informasi pengguna.
            </p>

        </div>

    </div>

    <div class="card-body">

        <form method="post" action="<?= site_url('user/edit/' . $user['id']); ?>">

            <?= csrf_field(); ?>

            <div class="row g-4">

                <div class="col-md-6">

                    <label class="form-label-custom">
                        Nama Lengkap
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control-custom"
                        value="<?= old('name', $user['fullname']); ?>">

                </div>

                <div class="col-md-6">

                    <label class="form-label-custom">
                        Username
                    </label>

                    <input
                        type="text"
                        name="username"
                        class="form-control-custom"
                        value="<?= old('username', $user['username']); ?>">

                </div>

                <div class="col-md-6">

                    <label class="form-label-custom">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control-custom"
                        value="<?= old('email', $user['email']); ?>">

                </div>

                <div class="col-md-6">

                    <label class="form-label-custom">
                        Password Baru
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control-custom"
                        placeholder="Kosongkan jika tidak diubah">

                </div>

                <div class="col-md-6">

                    <label class="form-label-custom">
                        Role
                    </label>

                    <select
                        name="role"
                        class="form-select-custom">

                        <option value="admin" <?= old('role', $user['role']) == 'admin' ? 'selected' : ''; ?>>
                            Admin
                        </option>

                        <option value="user" <?= old('role', $user['role']) == 'user' ? 'selected' : ''; ?>>
                            User
                        </option>

                    </select>

                </div>

                <div class="col-md-6">

                    <label class="form-label-custom">
                        Status
                    </label>

                    <select
                        name="status"
                        class="form-select-custom">

                        <option value="active" <?= old('status', $user['status']) == 'active' ? 'selected' : ''; ?>>
                            Active
                        </option>

                        <option value="inactive" <?= old('status', $user['status']) == 'inactive' ? 'selected' : ''; ?>>
                            Inactive
                        </option>

                    </select>

                </div>

            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-between">

                <a href="<?= site_url('user'); ?>"
                   class="btn-custom btn-outline-custom">

                    <i class="bi bi-arrow-left"></i>

                    Batal

                </a>

                <button
                    type="submit"
                    class="btn-custom btn-primary-custom">

                    <i class="bi bi-check-lg"></i>

                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>

</div>