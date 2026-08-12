<div class="card-custom">

    <div class="card-header-custom d-flex justify-content-between align-items-center">

        <div>

            <h4 class="mb-1">

                Voucher

            </h4>

            <p class="text-muted mb-0">

                Daftar voucher yang dapat ditukarkan menggunakan point.

            </p>

        </div>

    </div>

    <div class="card-body">

        <?php if (empty($vouchers)): ?>

            <div class="empty-state">

                <h5>

                    Belum Ada Voucher

                </h5>

                <p class="text-muted mb-0">

                    Saat ini belum ada voucher yang tersedia.

                </p>

            </div>

        <?php else: ?>

            <div class="row">

                <?php foreach ($vouchers as $voucher): ?>

                    <div class="col-lg-4 mb-4">

                        <div class="card h-100">

                            <div class="card-body">

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

                                <h5>

                                    <?= esc($voucher['title']); ?>

                                </h5>

                                <p>

                                    <?= esc($voucher['description']); ?>

                                </p>

                                <h4 class="text-success">

                                    <?= number_format($voucher['point']); ?>

                                    Point

                                </h4>

                                <a
                                    href="<?= site_url('user/voucher/' . $voucher['id']); ?>"
                                    class="btn btn-success">

                                    Detail

                                </a>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

    </div>

</div>