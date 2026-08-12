<div class="dashboard-panel">

    <div class="panel-header">

        <h5>

            <i class="bi bi-cash-stack me-2"></i>

            Ajukan Withdrawal

        </h5>

    </div>

    <div class="panel-body">

        <form method="post" action="<?= site_url('user/withdrawal/create'); ?>">

            <?= csrf_field(); ?>

            <div class="row">

                <div class="col-md-6 mb-4">

                    <label class="form-label">

                        Jumlah Withdrawal

                    </label>

                    <input
                        type="number"
                        name="amount"
                        class="form-control-custom"
                        placeholder="Masukkan jumlah point"
                        required>

                </div>

                <div class="col-md-6 mb-4">

                    <label class="form-label">

                        Bank / E-Wallet

                    </label>

                    <select
                        name="bank_code"
                        class="form-select-custom"
                        required>

                        <option value="">

                            Pilih Bank

                        </option>

                        <option value="bca">

                            BCA

                        </option>

                        <option value="bni">

                            BNI

                        </option>

                        <option value="bri">

                            BRI

                        </option>

                        <option value="mandiri">

                            Mandiri

                        </option>

                        <option value="gopay">

                            GoPay

                        </option>

                        <option value="ovo">

                            OVO

                        </option>

                        <option value="dana">

                            DANA

                        </option>

                        <option value="shopeepay">

                            ShopeePay

                        </option>

                    </select>

                </div>

                <div class="col-md-6 mb-4">

                    <label class="form-label">

                        Nama Pemilik Rekening

                    </label>

                    <input
                        type="text"
                        name="account_name"
                        class="form-control-custom"
                        placeholder="Nama sesuai rekening"
                        required>

                </div>

                <div class="col-md-6 mb-4">

                    <label class="form-label">

                        Nomor Rekening

                    </label>

                    <input
                        type="text"
                        name="account_number"
                        class="form-control-custom"
                        placeholder="Masukkan nomor rekening"
                        required>

                </div>

            </div>

            <div class="d-flex justify-content-end gap-2">

                <a
                    href="<?= site_url('user/withdrawal'); ?>"
                    class="btn-back">

                    <i class="bi bi-arrow-left"></i>

                    Kembali

                </a>

                <button
                    type="submit"
                    class="btn-search">

                    <i class="bi bi-send"></i>

                    Ajukan Withdrawal

                </button>

            </div>

        </form>

    </div>

</div>