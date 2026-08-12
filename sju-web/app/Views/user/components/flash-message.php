<?php if (session()->getFlashdata('success')): ?>

    <div class="alert-custom alert-success">

        <i class="bi bi-check-circle-fill"></i>

        <span>

            <?= session()->getFlashdata('success'); ?>

        </span>

    </div>

<?php endif; ?>


<?php if (session()->getFlashdata('error')): ?>

    <div class="alert-custom alert-danger">

        <i class="bi bi-x-circle-fill"></i>

        <span>

            <?= session()->getFlashdata('error'); ?>

        </span>

    </div>

<?php endif; ?>