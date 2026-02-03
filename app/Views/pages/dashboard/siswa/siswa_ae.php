<?php
/**
 * @var string $title
 * @var string $action
 * @var string $npsn
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
                            <div class="row">
                                <div class="col-lg-2 col-12">
                                    <div class="form-group">
                                        <label for="sekolah">Sekolah</label>
                                        <input type="text" name="sekolah" class="form-control" id="sekolah" value="<?= $npsn ?>" autocomplete="off" readonly required>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-12">
                                    <div class="form-group">
                                        <label for="nisn">NISN</label>
                                        <?php if(session()->has('validasi') && isset(session('validasi')['nip'])): ?>
                                            <small class="text-danger"><?= session('validasi')['nip'] ?></small>
                                        <?php endif ?>
                                        <input type="text" name="nisn" class="form-control" id="nisn" value="<?= ($mode == 'edit' || $mode == 'fixed') ? $data->nisn : ''  ?>" autocomplete="off">
                                        <?php if($mode == "fixed"): ?>
                                            <input type="hidden" name="nisn-fail" class="form-control" id="nisn-fail" value="<?= $data->nisn ?>" autocomplete="off" readonly required>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="nik">NIK</label>
                                        <?php if(session()->has('validasi') && isset(session('validasi')['nik'])): ?>
                                        <small class="text-danger"><?= session('validasi')['nik'] ?></small>
                                        <?php endif ?>
                                        <input type="text" name="nik" class="form-control" id="nik" value="<?= ($mode == 'edit' || $mode == 'fixed') ? $data->nik : '' ?>" autocomplete="off" maxlength="16">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-12">
                                    <div class="form-group">
                                        <label for="kk">Nomor KK</label>
                                        <?php if(session()->has('validasi') && isset(session('validasi')['nomor_kk'])): ?>
                                        <small class="text-danger"><?= session('validasi')['nomor_kk'] ?></small>
                                        <?php endif ?>
                                        <input type="text" name="kk" class="form-control" id="kk" value="<?= ($mode == 'edit' || $mode == 'fixed') ? $data->nomor_kk : ''  ?>" autocomplete="off" maxlength="16" required>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-12">
                                    <div class="form-group">
                                        <label for="pkh">Nomor PKH</label>
                                        <?php if(session()->has('validasi') && isset(session('validasi')['nomor_pkh'])): ?>
                                        <small class="text-danger"><?= session('validasi')['nomor_pkh'] ?></small>
                                        <?php endif ?>
                                        <input type="text" name="pkh" class="form-control" id="pkh" value="<?= ($mode == 'edit' || $mode == 'fixed') ? $data->nomor_pkh : ''  ?>" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-12">
                                    <div class="form-group">
                                        <label for="pip">Nomor PIP</label>
                                        <?php if(session()->has('validasi') && isset(session('validasi')['nomor_pip'])): ?>
                                        <small class="text-danger"><?= session('validasi')['nomor_pip'] ?></small>
                                        <?php endif ?>
                                        <input type="text" name="pip" class="form-control" id="pip" value="<?= ($mode == 'edit' || $mode == 'fixed') ? $data->nomor_pip : ''  ?>" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="nama">Nama Siswa</label>
                                        <?php if(session()->has('validai') && isset(session('validasi')['nama_siswa'])): ?>
                                            <small class="text-danger"><?= session('validasi')['nama_siswa'] ?></small>
                                        <?php endif ?>
                                        <input type="text" name="nama" class="form-control" id="nama" value="<?= ($mode == 'edit' || $mode == 'fixed') ? $data->nama_siswa : ''  ?>" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="ibu-kandung">Nama Ibu Kandung</label>
                                        <?php if(session()->has('validasi') && isset(session('validasi')['ibu_kandung'])): ?>
                                        <small class="text-danger"><?= session('validasi')['ibu_kandung'] ?></small>
                                        <?php endif ?>
                                        <input type="text" name="ibu-kandung" class="form-control" id="ibu-kandung" value="<?= ($mode == 'edit' || $mode == 'fixed') ? $data->ibu_kandung : '' ?>" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                        <label for="tempat">Tempat Lahir</label>
                                        <input type="text" name="tempat" class="form-control" id="tempat" value="<?= ($mode == 'edit' || $mode == 'fixed') ? $data->tempat_lahir : ''  ?>" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                        <label for="tgl">Tanggal Lahir</label>
                                        <input type="date" name="tgl" class="form-control" id="tgl" value="<?= ($mode == 'edit' || $mode == 'fixed') ? $data->tanggal_lahir : ''  ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                        <label for="jk">Jenis Kelamin</label>
                                        <select name="jk" class="form-control" id="jk">
                                            <option>--- Pilih Jenis Kelamin ---</option>
                                            <option value="l" <?= (($mode == 'edit' || $mode == 'fixed') && $data->jk == "l") ? 'selected' : ''  ?>>Laki-Laki</option>
                                            <option value="p" <?= (($mode == 'edit' || $mode == 'fixed') && $data->jk == "p") ? 'selected' : ''  ?>>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                        <label for="status">Status Kewarganegaraan</label>
                                        <?php if(session()->has('validasi') && isset(session('validasi')['alamat'])): ?>
                                        <small class="text-danger"><?= session('validasi')['alamat'] ?></small>
                                        <?php endif ?>
                                        <select name="status" class="form-control" id="status">
                                            <option>--- Pilih Status Kewarganegaraan ---</option>
                                            <?php foreach(\App\Utils\Options::$status_siswa as $row => $key): ?>
                                                <option value="<?= $row ?>" <?= (($mode == 'edit' || $mode == 'fixed') && $data->status == $row) ? 'selected' : ''  ?>><?= $key ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-12">
                                    <div class="form-group">
                                        <label for="desa">Desa</label>
                                        <?php if(session()->has('validasi') && isset(session('validasi')['desa'])): ?>
                                        <small class="text-danger"><?= session('validasi')['desa'] ?></small>
                                        <?php endif ?>
                                        <input type="text" name="desa" class="form-control" id="desa" value="<?= ($mode == 'edit' || $mode == 'fixed') ? $data->desa : '' ?>" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <div class="form-group">
                                        <label for="kabupaten">Kabupaten</label>
                                        <?php if(session()->has('validasi') && isset(session('validasi')['kabupaten'])): ?>
                                        <small class="text-danger"><?= session('validasi')['kabupaten'] ?></small>
                                        <?php endif ?>
                                        <input type="text" name="kabupaten" class="form-control" id="kabupaten" value="<?= ($mode == 'edit' || $mode == 'fixed') ? $data->kabupaten : '' ?>" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <div class="form-group">
                                        <label for="kecamatan">Kecamatan</label>
                                        <?php if(session()->has('validasi') && isset(session('validasi')['kecamatan'])): ?>
                                        <small class="text-danger"><?= session('validasi')['kecamatan'] ?></small>
                                        <?php endif ?>
                                        <input type="text" name="kecamatan" class="form-control" id="kecamatan" value="<?= ($mode == 'edit' || $mode == 'fixed') ? $data->kecamatan : '' ?>" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" class="form-control" id="alamat"><?= ($mode == 'edit' || $mode == 'fixed') ? $data->alamat : ''  ?></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-success">
                                    <span>Simpan</span>
                                    <i class="fas fa-save"></i>
                                </button>
                                <?php if(session('is_admin') && !$data->is_verify): ?>
                                <a href="<?= site_url('siswa/verifikasi/'.$data->idsiswa) ?>" class="btn btn-sm btn-primary">
                                    <span>Verifikasi</span>
                                    <i class="fas fa-check"></i>
                                </a>
                                <?php endif ?>
                                <a href="<?= previous_url() ?>" class="btn btn-sm btn-warning">
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
