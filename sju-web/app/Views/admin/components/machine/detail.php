<div class="card">

    <div class="card-header">

        <div>

            <h5 class="card-title">

                Detail Machine

            </h5>

            <p class="card-subtitle">

                Informasi lengkap mesin Reverse Vending Machine.

            </p>

        </div>

    </div>

    <div class="card-body">

        <div class="row g-4">

            <div class="col-md-6">

                <label class="form-label-custom">
                    Kode Machine
                </label>

                <input
                    type="text"
                    class="form-control-custom"
                    value="<?= esc($machine['machine_code']); ?>"
                    readonly>

            </div>

            <div class="col-md-6">

                <label class="form-label-custom">
                    Nama Machine
                </label>

                <input
                    type="text"
                    class="form-control-custom"
                    value="<?= esc($machine['machine_name']); ?>"
                    readonly>

            </div>

            <div class="col-md-12">

                <label class="form-label-custom">
                    Lokasi
                </label>

                <input
                    type="text"
                    class="form-control-custom"
                    value="<?= esc($machine['location']); ?>"
                    readonly>

            </div>

            <div class="col-md-6">

                <label class="form-label-custom">
                    Latitude
                </label>

                <input
                    type="text"
                    class="form-control-custom"
                    value="<?= esc($machine['latitude']); ?>"
                    readonly>

            </div>

            <div class="col-md-6">

                <label class="form-label-custom">
                    Longitude
                </label>

                <input
                    type="text"
                    class="form-control-custom"
                    value="<?= esc($machine['longitude']); ?>"
                    readonly>

            </div>

            <div class="col-md-6">

                <label class="form-label-custom">
                    IP Address
                </label>

                <input
                    type="text"
                    class="form-control-custom"
                    value="<?= esc($machine['ip_address']); ?>"
                    readonly>

            </div>

            <div class="col-md-6">

                <label class="form-label-custom">
                    Firmware
                </label>

                <input
                    type="text"
                    class="form-control-custom"
                    value="<?= esc($machine['firmware_version']); ?>"
                    readonly>

            </div>

            <div class="col-md-6">

                <label class="form-label-custom">
                    Status
                </label>

                <input
                    type="text"
                    class="form-control-custom"
                    value="<?= ucfirst($machine['status']); ?>"
                    readonly>

            </div>

            <div class="col-md-6">

                <label class="form-label-custom">
                    Last Online
                </label>

                <input
                    type="text"
                    class="form-control-custom"
                    value="<?= $machine['last_online'] ? date('d F Y H:i', strtotime($machine['last_online'])) : 'Belum Pernah Online'; ?>"
                    readonly>

            </div>

            <div class="col-md-6">

                <label class="form-label-custom">
                    Dibuat Pada
                </label>

                <input
                    type="text"
                    class="form-control-custom"
                    value="<?= date('d F Y H:i', strtotime($machine['created_at'])); ?>"
                    readonly>

            </div>

        </div>

    </div>

</div>