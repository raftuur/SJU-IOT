<form action="<?= site_url('auth/login'); ?>" method="post">
    <?= csrf_field(); ?>
    
    <div class="mb-3">
        <label for="email" class="form-label">
            Email
        </label>
        <input
            type="email"
            id="email"
            name="email"
            class="form-control"
            placeholder="Masukkan email"
            autocomplete="email"
            value="<?= old('email'); ?>"
            required>
        <div class="invalid-feedback">
            Silakan masukkan email.
        </div>
    </div>

    <div class="mb-4">
        <label for="password" class="form-label">
            Password
        </label>
        <input
            type="password"
            id="password"
            name="password"
            class="form-control"
            placeholder="Masukkan password"
            autocomplete="current-password"
            required>
        <div class="invalid-feedback">
            Silakan masukkan password.
        </div>
    </div>

    <button
        type="submit"
        id="btn-login"
        class="btn btn-success w-100">
        Login
    </button>
</form>