<div class="voucher-section">

    <div class="voucher-section-header">

        <div>

            <h4>
                Voucher
            </h4>

            <p>
                Daftar voucher yang dapat ditukarkan menggunakan point.
            </p>

        </div>

    </div>


    <div class="voucher-section-body">

        <?php if (empty($vouchers)): ?>

            <div class="voucher-empty">

                <div class="voucher-empty-icon">
                    <i class="bi bi-ticket-perforated"></i>
                </div>

                <h5>
                    Belum Ada Voucher
                </h5>

                <p>
                    Saat ini belum ada voucher yang tersedia.
                </p>

            </div>

        <?php else: ?>

            <div class="voucher-grid">

                <?php foreach ($vouchers as $voucher): ?>

                    <div class="voucher-card">

                        <div class="voucher-image-wrapper">

                            <?php if (!empty($voucher['image'])): ?>

                                <img
                                    src="<?= base_url('uploads/vouchers/' . $voucher['image']); ?>"
                                    alt="<?= esc($voucher['title']); ?>"
                                    class="voucher-image">

                            <?php else: ?>

                                <div class="voucher-image-placeholder">

                                    <i class="bi bi-image"></i>

                                </div>

                            <?php endif; ?>

                        </div>


                        <div class="voucher-card-body">

                            <h5 class="voucher-title">

                                <?= esc($voucher['title']); ?>

                            </h5>


                            <p class="voucher-description">

                                <?= esc($voucher['description']); ?>

                            </p>


                            <div class="voucher-point">

                                <i class="bi bi-coin"></i>

                                <?= number_format($voucher['point']); ?>

                                Point

                            </div>


                            <a
                                href="<?= site_url('user/voucher/' . $voucher['id']); ?>"
                                class="voucher-detail-button">

                                <i class="bi bi-eye me-1"></i>

                                Detail

                            </a>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

    </div>

</div>