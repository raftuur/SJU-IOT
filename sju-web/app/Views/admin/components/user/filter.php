<form method="get" action="<?= site_url('user'); ?>">

    <div class="filter-card">

        <div class="filter-header">

            <h5>Filter User</h5>

        </div>

        <div class="filter-body">

            <div class="filter-grid">

                <!-- Cari User -->
                <div class="filter-item">

                    <label class="form-label-custom">
                        Cari User
                    </label>

                    <div class="search-box">

                        <i class="bi bi-search"></i>

                        <input
                            type="text"
                            name="search"
                            class="form-control-custom"
                            value="<?= esc($search ?? ''); ?>"
                            placeholder="Cari nama, email atau username...">

                    </div>

                </div>

                <!-- Role -->
                <div class="filter-item">

                    <label class="form-label-custom">
                        Role
                    </label>

                    <select name="role" class="form-select-custom">

                        <option value="">Semua</option>

                        <option value="admin" <?= ($role ?? '') == 'admin' ? 'selected' : ''; ?>>
                            Admin
                        </option>

                        <option value="user" <?= ($role ?? '') == 'user' ? 'selected' : ''; ?>>
                            User
                        </option>

                    </select>

                </div>

                <!-- Status -->
                <div class="filter-item">

                    <label class="form-label-custom">
                        Status
                    </label>

                    <select name="status" class="form-select-custom">

                        <option value="">Semua</option>

                        <option value="active" <?= ($status ?? '') == 'active' ? 'selected' : ''; ?>>
                            Active
                        </option>

                        <option value="inactive" <?= ($status ?? '') == 'inactive' ? 'selected' : ''; ?>>
                            Inactive
                        </option>

                    </select>

                </div>

                <!-- Button -->
                <div class="filter-action">

                    <button
                        type="submit"
                        class="btn-custom btn-primary-custom">

                        <i class="bi bi-search"></i>

                        Cari

                    </button>

                    <a href="<?= site_url('user'); ?>" class="btn-custom btn-outline-custom btn-icon">

                        <i class="bi bi-arrow-clockwise"></i>

                    </a>

                </div>

            </div>

        </div>

    </div>

</form>