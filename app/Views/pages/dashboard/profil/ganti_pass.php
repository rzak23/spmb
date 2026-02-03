<?= $this->extend('layout/dashboard_layout') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <div class="content-header"></div>

    <section class="content">
        <div class="container-fluid">
            <?php if(session()->has('error')): ?>
            <div class="alert alert-danger"><?= session('error') ?></div>
            <?php endif ?>

            <?php if(session()->has('success')): ?>
            <div class="alert alert-success"><?= session('success') ?></div>
            <?php endif ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">Ganti Password</h6>
                        </div>
                        <div class="card-body">
                            <?= form_open('profil/update-pass') ?>
                            <div class="form-group">
                                <label for="old-pass">Password Lama</label>
                                <?php if(session()->has('validasi') && isset(session('validasi')['old_pass'])): ?>
                                <small class="text-danger"><?= session('validasi')['old_pass'] ?></small>
                                <?php endif ?>
                                <input type="password" name="old-pass" class="form-control" id="old-pass" required>
                            </div>
                            <div class="form-group">
                                <label for="new-pass">Password Baru</label>
                                <?php if(session()->has('validasi') && isset(session('validasi')['new_pass'])): ?>
                                <small class="text-danger"><?= session('validasi')['new_pass'] ?></small>
                                <?php endif ?>
                                <input type="password" name="new-pass" class="form-control" id="new-pass" required>
                            </div>
                            <div class="form-group">
                                <label for="re-pass">Konfirmasi Password Baru</label>
                                <?php if(session()->has('validasi') && isset(session('validasi')['re_pass'])): ?>
                                <small class="text-danger"><?= session('validasi')['re_pass'] ?></small>
                                <?php endif ?>
                                <input type="password" name="re-pass" class="form-control" id="re-pass" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-success">
                                    <span>Simpan</span>
                                    <i class="fas fa-save"></i>
                                </button>
                            </div>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
