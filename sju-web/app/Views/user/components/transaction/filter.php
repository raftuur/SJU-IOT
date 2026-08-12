<form method="get" action="<?= site_url('user/transaction'); ?>">

    <div class="filter-card">

        <div class="filter-header">

            <h5>Filter Transaction</h5>

        </div>

        <div class="filter-body">

            <div class="filter-grid">

                <div class="filter-item search-column">

                    <label class="form-label">
                        Cari Transaction
                    </label>

                    <div class="search-box">

                        <i class="bi bi-search"></i>

                        <input
                            type="text"
                            name="search"
                            class="form-control-custom"
                            value="<?= esc($search ?? ''); ?>"
                            placeholder="Cari kode transaksi...">

                    </div>

                </div>

                <div class="filter-item status-column">

                    <label class="form-label">
                        Status
                    </label>

                    <select
                        name="status"
                        class="form-select-custom">

                        <option value="">
                            Semua Status
                        </option>

                        <option value="success"
                            <?= ($status ?? '') == 'success' ? 'selected' : ''; ?>>

                            Success

                        </option>

                        <option value="failed"
                            <?= ($status ?? '') == 'failed' ? 'selected' : ''; ?>>

                            Failed

                        </option>

                    </select>

                </div>

                <div class="filter-action">

                    <button
                        type="submit"
                        class="btn-search">

                        <i class="bi bi-search me-1"></i>

                        Cari

                    </button>

                    <a
                        href="<?= site_url('user/transaction'); ?>"
                        class="btn-reset">

                        <i class="bi bi-arrow-clockwise"></i>

                    </a>

                </div>

            </div>

        </div>

    </div>

</form>