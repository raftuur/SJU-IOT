<div class="card">

    <div class="card-header">

        <div>

            <h5 class="card-title">

                <?= isset($machine) ? 'Edit Machine' : 'Tambah Machine'; ?>

            </h5>

            <p class="card-subtitle">

                <?= isset($machine) ? 'Perbarui informasi mesin Reverse Vending Machine.' : 'Lengkapi informasi mesin Reverse Vending Machine.'; ?>

            </p>

        </div>

    </div>

    <div class="card-body">

        <form method="post"
              action="<?= isset($machine)
                    ? site_url('machine/edit/' . $machine['id'])
                    : site_url('machine/create'); ?>">

            <?= csrf_field(); ?>

            <div class="row g-4">

                <div class="col-md-6">

                    <label class="form-label-custom">

                        Kode Machine

                    </label>

                    <input
                        type="text"
                        name="machine_code"
                        class="form-control-custom"
                        value="<?= old('machine_code', $machine['machine_code'] ?? ($machineCode ?? '')); ?>"
                        readonly>

                </div>

                <div class="col-md-6">

                    <label class="form-label-custom">

                        Nama Machine

                    </label>

                    <input
                        type="text"
                        name="machine_name"
                        class="form-control-custom"
                        placeholder="Contoh : RVM Gedung A"
                        value="<?= old('machine_name', $machine['machine_name'] ?? ''); ?>">

                </div>

                <div class="col-md-12">

                    <label class="form-label-custom">

                        Lokasi

                    </label>

                    <input
                        type="text"
                        name="location"
                        class="form-control-custom"
                        placeholder="Contoh : Lobby Gedung A"
                        value="<?= old('location', $machine['location'] ?? ''); ?>">

                </div>

                <div class="col-md-6">

                    <label class="form-label-custom">

                        Latitude

                    </label>

                    <input
                        type="text"
                        name="latitude"
                        class="form-control-custom"
                        placeholder="-3.3212345"
                        value="<?= old('latitude', $machine['latitude'] ?? ''); ?>">

                </div>

                <div class="col-md-6">

                    <label class="form-label-custom">

                        Longitude

                    </label>

                    <input
                        type="text"
                        name="longitude"
                        class="form-control-custom"
                        placeholder="114.5876543"
                        value="<?= old('longitude', $machine['longitude'] ?? ''); ?>">

                </div>

                <div class="col-md-6">

                    <label class="form-label-custom">

                        IP Address

                    </label>

                    <input
                        type="text"
                        name="ip_address"
                        class="form-control-custom"
                        placeholder="192.168.1.100"
                        value="<?= old('ip_address', $machine['ip_address'] ?? ''); ?>">

                </div>

                <div class="col-md-6">

                    <label class="form-label-custom">

                        Firmware

                    </label>

                    <input
                        type="text"
                        name="firmware_version"
                        class="form-control-custom"
                        placeholder="v1.0.0"
                        value="<?= old('firmware_version', $machine['firmware_version'] ?? ''); ?>">

                </div>

                <div class="col-md-6">

                    <label class="form-label-custom">

                        Status

                    </label>

                    <select
                        name="status"
                        class="form-select-custom">

                        <option value="offline"
                            <?= old('status', $machine['status'] ?? 'offline') == 'offline' ? 'selected' : ''; ?>>
                            Offline
                        </option>

                        <option value="online"
                            <?= old('status', $machine['status'] ?? '') == 'online' ? 'selected' : ''; ?>>
                            Online
                        </option>

                        <option value="maintenance"
                            <?= old('status', $machine['status'] ?? '') == 'maintenance' ? 'selected' : ''; ?>>
                            Maintenance
                        </option>

                    </select>

                </div>

            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-between">

                <a href="<?= site_url('machine'); ?>"
                   class="btn-custom btn-outline-custom">

                    <i class="bi bi-arrow-left"></i>

                    Batal

                </a>

                <button
                    type="submit"
                    class="btn-custom btn-primary-custom">

                    <i class="bi bi-check-lg"></i>

                    <?= isset($machine) ? 'Update Machine' : 'Simpan Machine'; ?>

                </button>

            </div>

        </form>

    </div>

</div>