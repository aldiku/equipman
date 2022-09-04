<?= $this->extend('template/template_frontend') ?>
<?= $this->section('main') ?>


<div class="card">
    <div class="card-body login-card-body">
        <p class="text-center"><?= lang('Auth.enterEmailForInstructions') ?></p>
        <?= view('Myth\Auth\Views\_message_block') ?>
        <form action="<?= route_to('forgot') ?>" method="post">
            <?= csrf_field() ?>
            <div class="input-group mb-3">
                <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.sendInstructions') ?></button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <p class="mt-3 mb-1">
            <a href="<?= route_to('login'); ?>"><?= lang('Auth.loginAction'); ?></a>
        </p>
        <p class="mb-0">
            <a href="/register" class="text-center"><?= lang('Auth.needAnAccount'); ?></a>
        </p>
    </div>
    <!-- /.login-card-body -->
</div>

<?= $this->endSection() ?>