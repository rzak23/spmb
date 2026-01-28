<?php
/**
 * @var string $title
 * @var string $action
 * @var string $npsn
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
                            <div class="row">
                                <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                        <label for="sekolah">Sekolah</label>
                                        <input type="text" name="sekolah" class="form-control" id="sekolah" value="<?= $npsn ?>" autocomplete="off" readonly required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                        <label for="kk">Nomor KK</label>
                                        <input type="text" name="kk" class="form-control" id="kk" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                        <label for="pkh">Nomor PKH</label>
                                        <input type="text" name="pkh" class="form-control" id="pkh" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                        <label for="pip">Nomor PIP</label>
                                        <input type="text" name="pip" class="form-control" id="pip" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="nip">NIP</label>
                                        <input type="text" name="nip" class="form-control" id="nip" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="nama">Nama Siswa</label>
                                        <input type="text" name="nama" class="form-control" id="nama" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                        <label for="tempat">Tempat Lahir</label>
                                        <input type="text" name="tempat" class="form-control" id="tempat" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                        <label for="tgl">Tanggal Lahir</label>
                                        <input type="date" name="tgl" class="form-control" id="tgl" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                        <label for="jk">Jenis Kelamin</label>
                                        <select name="jk" class="form-control" id="jk">
                                            <option>--- Pilih Jenis Kelamin ---</option>
                                            <option value="l">Laki-Laki</option>
                                            <option value="p">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                        <label for="status">Status Kewarganegaraan</label>
                                        <select name="status" class="form-control" id="status">
                                            <option>--- Pilih Status Kewarganegaraan ---</option>
                                            <?php foreach(\App\Utils\Options::$status_siswa as $row => $key): ?>
                                                <option value="<?= $row ?>"><?= $key ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" class="form-control" id="alamat"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-success">
                                    <span>Simpan</span>
                                    <i class="fas fa-save"></i>
                                </button>
                                <a href="<?= site_url('siswa') ?>" class="btn btn-sm btn-warning">
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
