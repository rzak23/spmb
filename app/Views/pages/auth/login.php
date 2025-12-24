<?= $this->extend('layout/auth_layout') ?>

<?= $this->section('content') ?>
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="<?= site_url() ?>" class="h1"><strong>SPMB</strong></a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Login to start your session</p>

            <?php if(session()->has('error')): ?>
            <div class="alert alert-danger"><?= session('error') ?></div>
            <?php endif ?>

            <?= form_open('login') ?>
                <div class="input-group mb-3">
                    <label class="d-none" for="username"></label>
                    <input type="text" name="username" class="form-control" id="username" autocomplete="off" placeholder="Username" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user-alt"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <label class="d-none" for="password"></label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8"></div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>
                    <!-- /.col -->
                </div>
            <?= form_close() ?>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->
<?= $this->endSection() ?>
