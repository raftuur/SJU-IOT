<form method="get" action="<?= site_url('machine'); ?>">

    <div class="filter-card">

        <div class="filter-header">

            <h5>Filter Machine</h5>

        </div>

        <div class="filter-body">

            <div class="filter-grid">

                <div class="filter-item filter-search">

                    <label>Cari Machine</label>

                    <div class="search-box">

                        <i class="bi bi-search"></i>

                        <input
                            type="text"
                            name="search"
                            class="form-control-custom"
                            value="<?= esc($search ?? ''); ?>"
                            placeholder="Cari kode, nama atau lokasi...">

                    </div>

                </div>

                <div class="filter-item">

                    <label>Status</label>

                    <select
                        name="status"
                        class="form-select-custom">

                        <option value="">Semua Status</option>

                        <option value="online"
                            <?= ($status ?? '') == 'online' ? 'selected' : ''; ?>>

                            Online

                        </option>

                        <option value="offline"
                            <?= ($status ?? '') == 'offline' ? 'selected' : ''; ?>>

                            Offline

                        </option>

                        <option value="maintenance"
                            <?= ($status ?? '') == 'maintenance' ? 'selected' : ''; ?>>

                            Maintenance

                        </option>

                    </select>

                </div>

                <div class="filter-action">

                    <button
                        type="submit"
                        class="btn-search">

                        <i class="bi bi-search"></i>

                        Cari

                    </button>

                    <a
                        href="<?= site_url('machine'); ?>"
                        class="btn-reset">

                        <i class="bi bi-arrow-clockwise"></i>

                    </a>

                </div>

            </div>

        </div>

    </div>

</form>