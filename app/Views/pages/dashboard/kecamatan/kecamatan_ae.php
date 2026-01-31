<?php
/**
 * @var string $mode
 * @var string $action
 * @var string $title
 * @var object $data
 * @var object $kabupaten
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
                                <label for="kabupaten">Kabupaten</label>
                                <select name="kabupaten" class="form-control" id="kabupaten">
                                    <?php foreach($kabupaten as $row): ?>
                                    <option value="<?= $row->idkabupaten ?>" <?= ($mode == 'edit' && $row->idkabupaten == $data->idkabupaten) ? 'selected' : '' ?>>
                                        <?= $row->kabupaten ?>
                                    </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kecamatan">Kecamatan</label>
                                <input type="text" name="kecamatan" class="form-control" id="kecamatan" value="<?= ($mode == 'edit') ? $data->kecamatan : '' ?>" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-success">
                                    <span>Simpan</span>
                                    <i class="fas fa-save"></i>
                                </button>
                                <a href="<?= site_url('kecamatan') ?>" class="btn btn-sm btn-warning">
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
