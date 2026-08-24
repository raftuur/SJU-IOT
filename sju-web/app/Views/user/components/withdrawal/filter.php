<form
    method="get"
    action="<?= site_url('user/withdrawal'); ?>">

    <div class="withdrawal-filter">

        <div class="withdrawal-filter-header">

            <h5>
                <i class="bi bi-funnel me-2"></i>
                Filter Withdrawal
            </h5>

        </div>


        <div class="withdrawal-filter-body">

            <div class="withdrawal-filter-form">


                <div class="withdrawal-filter-group">

                    <label for="withdrawalSearch">
                        Cari Withdrawal
                    </label>

                    <input
                        type="text"
                        id="withdrawalSearch"
                        name="search"
                        class="form-control"
                        value="<?= esc($search ?? ''); ?>"
                        placeholder="Cari kode withdrawal...">

                </div>


                <div class="withdrawal-filter-group">

                    <label for="withdrawalStatus">
                        Status
                    </label>

                    <select
                        id="withdrawalStatus"
                        name="status"
                        class="form-select">

                        <option value="">
                            Semua Status
                        </option>

                        <option
                            value="pending"
                            <?= ($status ?? '') === 'pending'
                                ? 'selected'
                                : ''; ?>>
                            Pending
                        </option>

                        <option
                            value="processing"
                            <?= ($status ?? '') === 'processing'
                                ? 'selected'
                                : ''; ?>>
                            Processing
                        </option>

                        <option
                            value="completed"
                            <?= ($status ?? '') === 'completed'
                                ? 'selected'
                                : ''; ?>>
                            Completed
                        </option>

                        <option
                            value="rejected"
                            <?= ($status ?? '') === 'rejected'
                                ? 'selected'
                                : ''; ?>>
                            Rejected
                        </option>

                    </select>

                </div>


                <div class="withdrawal-filter-actions">

                    <button
                        type="submit"
                        class="btn btn-success">

                        <i class="bi bi-search me-1"></i>

                        Cari

                    </button>


                    <a
                        href="<?= site_url('user/withdrawal'); ?>"
                        class="btn-reset"
                        title="Reset Filter">

                        <i class="bi bi-arrow-clockwise"></i>

                    </a>

                </div>


            </div>

        </div>

    </div>

</form>