<div class="card">

    <div class="card-body">

        <h5 class="mb-4">
            Informasi Akun
        </h5>


        <div class="mb-3">

            <label class="form-label">
                Nama Lengkap
            </label>

            <input
                type="text"
                class="form-control"
                value="<?= esc($user['fullname'] ?? ''); ?>"
            >

        </div>


        <div class="mb-3">

            <label class="form-label">
                Username
            </label>

            <input
                type="text"
                class="form-control"
                value="<?= esc($user['username'] ?? ''); ?>"
            >

        </div>


        <div class="mb-3">

            <label class="form-label">
                Email
            </label>

            <input
                type="email"
                class="form-control"
                value="<?= esc($user['email'] ?? ''); ?>"
            >

        </div>


        <div class="mb-3">

            <label class="form-label">
                Nomor Telepon
            </label>

            <input
                type="text"
                class="form-control"
                value="<?= esc($user['phone'] ?? ''); ?>"
            >

        </div>


        <button
            type="button"
            class="btn btn-success">

            <i class="bi bi-save me-1"></i>

            Simpan Perubahan

        </button>

    </div>

</div>