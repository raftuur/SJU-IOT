<div class="withdrawal-form-panel">

    <div class="withdrawal-form-header">

        <h5>
            <i class="bi bi-cash-stack"></i>
            Ajukan Withdrawal
        </h5>

    </div>


    <div class="withdrawal-form-body">

        <form
            method="post"
            action="<?= site_url('user/withdrawal/create'); ?>">

            <?= csrf_field(); ?>


            <div class="withdrawal-form-grid">


                <!-- Jumlah Withdrawal -->

                <div class="withdrawal-form-group">

                    <label for="withdrawalAmount">
                        Jumlah Withdrawal
                    </label>

                    <input
                        type="number"
                        id="withdrawalAmount"
                        name="amount"
                        class="form-control"
                        placeholder="Masukkan jumlah point"
                        min="1"
                        required>

                </div>


                <!-- Bank / E-Wallet -->

                <div class="withdrawal-form-group">

                    <label for="withdrawalBank">
                        Bank / E-Wallet
                    </label>

                    <select
                        id="withdrawalBank"
                        name="bank_code"
                        class="form-select"
                        required>

                        <option value="">
                            Pilih Bank / E-Wallet
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


                <!-- Nama Rekening -->

                <div class="withdrawal-form-group">

                    <label for="accountName">
                        Nama Pemilik Rekening
                    </label>

                    <input
                        type="text"
                        id="accountName"
                        name="account_name"
                        class="form-control"
                        placeholder="Nama sesuai rekening"
                        required>

                </div>


                <!-- Nomor Rekening -->

                <div class="withdrawal-form-group">

                    <label for="accountNumber">
                        Nomor Rekening
                    </label>

                    <input
                        type="text"
                        id="accountNumber"
                        name="account_number"
                        class="form-control"
                        placeholder="Masukkan nomor rekening"
                        required>

                </div>


            </div>


            <!-- Action -->

            <div class="withdrawal-form-actions">

                <a
                    href="<?= site_url('user/withdrawal'); ?>"
                    class="btn btn-back">

                    <i class="bi bi-arrow-left"></i>

                    Kembali

                </a>


                <button
                    type="submit"
                    class="btn btn-success">

                    <i class="bi bi-send"></i>

                    Ajukan Withdrawal

                </button>

            </div>


        </form>

    </div>

</div>