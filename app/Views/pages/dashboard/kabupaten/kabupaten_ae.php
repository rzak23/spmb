<?php
/**
 * @var string $title
 * @var string $action
 * @var string $mode
 * @var object $data
 */
?>
<?= $this->extend('layout/dashboard_layout') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <div class="content-header"></div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <?php if(session()->has('error')): ?>
                        <div class="alert alert-danger"><?= session('error') ?></div>
                    <?php endif ?>
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title"><?= $title ?></h6>
                        </div>
                        <div class="card-body">
                            <?= form_open($action) ?>
                            <div class="form-group">
                                <label for="kabupaten">Nama Kabupaten</label>
                                <?php if(session()->has('validasi') && isset(session('validasi')['kabupaten'])): ?>
                                <small class="text-danger"><?= session('validasi')['kabupaten'] ?></small>
                                <?php endif ?>
                                <input type="text" name="kabupaten" class="form-control" id="kabupaten" value="<?= ($mode == 'edit') ? $data->kabupaten : '' ?>" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-success">
                                    <span>Simpan</span>
                                    <i class="fas fa-save"></i>
                                </button>
                                <a href="<?= site_url('kabupaten') ?>" class="btn btn-sm btn-warning">
                                    <span>Batal</span>
                                    <i class="fas fa-times"></i>
                                </a>
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
