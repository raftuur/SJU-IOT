<div class="card">

    <div class="card-header">

        <div>

            <h5 class="card-title">
                Tambah User
            </h5>

            <p class="card-subtitle">
                Lengkapi informasi pengguna baru yang akan ditambahkan ke sistem SJU.
            </p>

        </div>

    </div>

    <div class="card-body">

        <form method="post" action="<?= site_url('user/create'); ?>">

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
                        value="<?= old('name'); ?>"
                        placeholder="Masukkan nama lengkap">

                </div>

                <div class="col-md-6">

                    <label class="form-label-custom">
                        Username
                    </label>

                    <input
                        type="text"
                        name="username"
                        class="form-control-custom"
                        value="<?= old('username'); ?>"
                        placeholder="Masukkan username">

                </div>

                <div class="col-md-6">

                    <label class="form-label-custom">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control-custom"
                        value="<?= old('email'); ?>"
                        placeholder="Masukkan alamat email">

                </div>

                <div class="col-md-6">

                    <label class="form-label-custom">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control-custom"
                        placeholder="Masukkan password">

                </div>

                <div class="col-md-6">

                    <label class="form-label-custom">
                        Role
                    </label>

                    <select
                        name="role"
                        class="form-select-custom">

                        <option value="">

                            -- Pilih Role --

                        </option>

                        <option value="admin" <?= old('role') == 'admin' ? 'selected' : ''; ?>>

                            Admin

                        </option>

                        <option value="user" <?= old('role') == 'user' ? 'selected' : ''; ?>>

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

                        <option value="active" <?= old('status') == 'active' ? 'selected' : ''; ?>>

                            Active

                        </option>

                        <option value="inactive" <?= old('status') == 'inactive' ? 'selected' : ''; ?>>

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

                    Simpan User

                </button>

            </div>

        </form>

    </div>

</div>