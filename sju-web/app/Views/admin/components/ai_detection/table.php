<div class="card-custom">

    <div class="card-header-custom">

        <div>

            <h5 class="mb-1 fw-bold">
                AI Detection History
            </h5>

            <small class="text-muted">
                Riwayat hasil deteksi Artificial Intelligence.
            </small>

        </div>

        <form method="get" class="search-box">

            <div class="input-group">

                <input
                    type="text"
                    name="keyword"
                    class="form-control"
                    placeholder="Cari Detection ID..."
                    value="<?= esc($keyword); ?>">

                <button class="btn btn-primary">

                    <i class="bi bi-search"></i>

                </button>

            </div>

        </form>

    </div>

    <div class="table-responsive">

        <table class="table table-hover align-middle mb-0">

            <thead>

                <tr>

                    <th width="70">#</th>

                    <th width="90">Preview</th>

                    <th>Detection ID</th>

                    <th>Bottle</th>

                    <th>Cap</th>

                    <th>Label</th>

                    <th>Confidence</th>

                    <th>Created</th>

                    <th width="110">Action</th>

                </tr>

            </thead>

            <tbody>

                <?php if (empty($detections)) : ?>

                    <tr>

                        <td colspan="9" class="text-center py-5">

                            <i class="bi bi-robot fs-1 text-muted"></i>

                            <div class="mt-3">

                                Belum ada data AI Detection.

                            </div>

                        </td>

                    </tr>

                <?php endif; ?>

                <?php foreach ($detections as $index => $row) : ?>

                    <tr>

                        <td>

                            <?= $index + 1; ?>

                        </td>

                        <td>

                            <img
                                src="<?= base_url($row['detected_image']); ?>"
                                alt="Detection"
                                class="img-thumbnail detection-thumb">

                        </td>

                        <td>

                            <strong>

                                <?= esc($row['detection_id']); ?>

                            </strong>

                        </td>

                        <td>

                            <?php if ($row['bottle']) : ?>

                                <span class="badge bg-success">

                                    ✔

                                </span>

                            <?php else : ?>

                                <span class="badge bg-danger">

                                    ✖

                                </span>

                            <?php endif; ?>

                        </td>

                        <td>

                            <?php if ($row['cap']) : ?>

                                <span class="badge bg-success">

                                    ✔

                                </span>

                            <?php else : ?>

                                <span class="badge bg-danger">

                                    ✖

                                </span>

                            <?php endif; ?>

                        </td>

                        <td>

                            <?php if ($row['label']) : ?>

                                <span class="badge bg-success">

                                    ✔

                                </span>

                            <?php else : ?>

                                <span class="badge bg-danger">

                                    ✖

                                </span>

                            <?php endif; ?>

                        </td>

                        <td>

                            <span class="badge bg-primary">

                                <?= number_format($row['confidence'] * 100, 2); ?>%

                            </span>

                        </td>

                        <td>

                            <?= date('d M Y H:i', strtotime($row['created_at'])); ?>

                        </td>

                        <td>

                            <button
                                type="button"
                                class="btn btn-sm btn-primary btn-detail"

                                data-bs-toggle="modal"
                                data-bs-target="#detailModal"

                                data-detection-id="<?= esc($row['detection_id']); ?>"

                                data-bottle="<?= $row['bottle']; ?>"

                                data-cap="<?= $row['cap']; ?>"

                                data-label="<?= $row['label']; ?>"

                                data-confidence="<?= number_format($row['confidence'] * 100, 2); ?>"

                                data-original-image="<?= esc($row['original_image']); ?>"

                                data-detected-image="<?= esc($row['detected_image']); ?>"

                                data-created="<?= date('d M Y H:i:s', strtotime($row['created_at'])); ?>">

                                <i class="bi bi-eye"></i>

                            </button>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>