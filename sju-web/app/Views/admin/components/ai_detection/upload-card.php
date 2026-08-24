<div class="card-custom mb-4">

    <div class="card-header-custom">

        <div>

            <h5 class="mb-1 fw-bold">
                Test AI Detection
            </h5>

            <small class="text-muted">
                Uji deteksi botol menggunakan kamera atau gambar.
            </small>

        </div>

    </div>


    <div class="card-body p-4">

        <!-- CAMERA PREVIEW -->

        <div class="camera-wrapper mb-4">

            <div class="camera-preview">

                <video
                    id="aiCamera"
                    autoplay
                    playsinline>
                </video>

                <div
                    id="cameraPlaceholder"
                    class="camera-placeholder">

                    <i class="bi bi-camera-video"></i>

                    <span>
                        Kamera belum aktif
                    </span>

                </div>

            </div>

        </div>


        <!-- CAMERA ACTION -->

        <div class="d-flex gap-2 flex-wrap mb-4">

            <button
                type="button"
                id="btnStartCamera"
                class="btn btn-primary">

                <i class="bi bi-camera-video"></i>

                Buka Kamera

            </button>


            <button
                type="button"
                id="btnCapture"
                class="btn btn-success"
                disabled
                data-ai-test-url="<?= site_url('ai-detection/test'); ?>">

                <i class="bi bi-camera"></i>

                Ambil & Jalankan AI

            </button>


            <button
                type="button"
                id="btnStopCamera"
                class="btn btn-danger"
                disabled>

                <i class="bi bi-camera-video-off"></i>

                Tutup Kamera

            </button>

        </div>


        <!-- PEMISAH -->

        <div class="text-center text-muted mb-4">

            <span>atau upload gambar</span>

        </div>


        <!-- UPLOAD FILE -->

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
                        id="aiImage"
                        class="form-control"
                        accept="image/*">

                </div>


                <div class="col-md-2">

                    <button
                        type="submit"
                        class="btn btn-primary w-100">

                        <i class="bi bi-robot"></i>

                        Jalankan AI

                    </button>

                </div>

            </div>

        </form>


        <!-- CANVAS -->

        <canvas
            id="aiCanvas"
            class="d-none">
        </canvas>


        <!-- HASIL CAPTURE -->

        <div
            id="captureResult"
            class="mt-4 d-none">

            <h6 class="fw-bold mb-3">
                Gambar Pengujian
            </h6>

            <img
                id="capturedImage"
                src=""
                alt="Hasil capture"
                class="img-fluid rounded">

        </div>

    </div>

</div>