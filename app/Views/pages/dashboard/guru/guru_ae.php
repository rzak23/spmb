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
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="sekolah">Sekolah</label>
                                        <select name="sekolah" class="form-control" id="sekolah">
                                            <option>--- Pilih Sekolah ---</option>
                                            <?php foreach($sekolah as $row): ?>
                                                <option value="<?= $row->npsn ?>" <?= ($mode == 'edit' && $row->npsn == $data->idsekolah) ? 'selected' : '' ?>>
                                                    <?= $row->sekolah ?>
                                                </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="nip">NIP</label>
                                        <input type="text" name="nip" class="form-control" id="nip" value="<?= ($mode == 'edit') ? $data->nip : '' ?>" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" class="form-control" id="nama" value="<?= ($mode == 'edit') ? $data->nama_guru : '' ?>" autocomplete="off" required>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-12">
                                    <div class="form-group">
                                        <label for="telepon">Telepon</label>
                                        <input type="text" name="telepon" class="form-control" id="telepon" value="<?= ($mode == 'edit') ? $data->telepon : '' ?>" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" class="form-control" id="username" value="<?= ($mode == 'edit') ? $data->username : '' ?>" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <div class="form-group">
                                        <label for="pass">Password</label>
                                        <input type="password" name="pass" class="form-control" id="pass" <?= ($mode == 'add') ? 'required' : '' ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" class="form-control" id="alamat"><?= ($mode == 'edit') ? $data->alamat : '' ?></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-success">
                                    <span>Simpan</span>
                                    <i class="fas fa-save"></i>
                                </button>
                                <a href="<?= site_url('guru') ?>" class="btn btn-sm btn-warning">
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
