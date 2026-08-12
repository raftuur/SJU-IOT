<form method="get" action="<?= site_url('user/withdrawal'); ?>">

    <div class="filter-card">

        <div class="filter-header">

            <h5>

                <i class="bi bi-funnel me-2"></i>

                Filter Withdrawal

            </h5>

        </div>

        <div class="filter-body">

            <div class="filter-grid">

                <div class="filter-item filter-search">

                    <label>

                        Cari Withdrawal

                    </label>

                    <div class="search-box">

                        <i class="bi bi-search"></i>

                        <input
                            type="text"
                            name="search"
                            class="form-control-custom"
                            value="<?= esc($search ?? ''); ?>"
                            placeholder="Cari kode withdrawal...">

                    </div>

                </div>

                <div class="filter-item">

                    <label>

                        Status

                    </label>

                    <select
                        name="status"
                        class="form-select-custom">

                        <option value="">

                            Semua Status

                        </option>

                        <option
                            value="pending"
                            <?= ($status ?? '') == 'pending' ? 'selected' : ''; ?>>

                            Pending

                        </option>

                        <option
                            value="processing"
                            <?= ($status ?? '') == 'processing' ? 'selected' : ''; ?>>

                            Processing

                        </option>

                        <option
                            value="completed"
                            <?= ($status ?? '') == 'completed' ? 'selected' : ''; ?>>

                            Completed

                        </option>

                        <option
                            value="rejected"
                            <?= ($status ?? '') == 'rejected' ? 'selected' : ''; ?>>

                            Rejected

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
                        href="<?= site_url('user/withdrawal'); ?>"
                        class="btn-reset">

                        <i class="bi bi-arrow-clockwise"></i>

                    </a>

                </div>

            </div>

        </div>

    </div>

</form>