<div class="card-custom mb-4">

    <div class="card-header-custom">

        <div>

            <h5 class="mb-1 fw-bold">

                Test AI Detection

            </h5>

            <small class="text-muted">

                Upload gambar botol untuk diuji menggunakan YOLOv8.

            </small>

        </div>

    </div>

    <div class="card-body p-4">

        <form
            action="<?= site_url('ai-detection/test'); ?>"
            method="post"
            enctype="multipart/form-data">

            <?= csrf_field(); ?>

            <div class="row align-items-end">

                <div class="col-md-10">

                    <label class="form-label">

                        Pilih Gambar

                    </label>

                    <input
                        type="file"
                        name="image"
                        class="form-control"
                        accept="image/*"
                        required>

                </div>

                <div class="col-md-2">

                    <button
                        class="btn btn-primary w-100">

                        <i class="bi bi-robot"></i>

                        Jalankan AI

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>