<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<div class="card">
    <div class="card-body login-card-body">
        <p class="text-center"><?= lang('Auth.enterCodeEmailPassword') ?></p>
        <?= view('Myth\Auth\Views\_message_block') ?>
        <form action="<?= route_to('reset-password') ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <input type="text" class="form-control <?php if (session('errors.token')) : ?>is-invalid<?php endif ?>" name="token" placeholder="<?= lang('Auth.token') ?>" value="<?= old('token', $token ?? '') ?>">
                <div class="invalid-feedback">
                    <?= session('errors.token') ?>
                </div>
            </div>
            <div class="form-group">
                <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
                <div class="invalid-feedback">
                    <?= session('errors.email') ?>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" name="pass_confirm">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.resetPassword') ?></button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <p class="mt-3 mb-1">
            <a href="<?= route_to('login'); ?>">Login</a>
        </p>
    </div>
    <!-- /.login-card-body -->
</div>

<?= $this->endSection() ?>