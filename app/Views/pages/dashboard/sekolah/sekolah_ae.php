<?php
/**
 * @var string $title
 * @var string $action
 * @var string $mode
 * @var object $kabupaten
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
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="kabupaten">Kabupaten</label>
                                        <select name="kabupaten" class="form-control" id="kabupaten" onchange="onClickKabupaten()">
                                            <option>--- Pilih Kabupaten ---</option>
                                            <?php foreach($kabupaten as $row): ?>
                                            <option value="<?= $row->idkabupaten ?>" <?= ($mode == 'edit' && $row->idkabupaten == $data->idkabupaten) ? 'selected' : '' ?>>
                                                <?= $row->kabupaten ?>
                                            </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="kecamatan">Kecamatan</label>
                                        <select name="kecamatan" class="form-control" id="kecamatan">
                                            <option>--- Pilih Kecamatan ---</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="npsn">NPSN</label>
                                        <?php if(session()->has('validasi') && isset(session('validasi')['npsn'])): ?>
                                        <small class="text-danger"><?= session('validasi')['npsn'] ?></small>
                                        <?php endif ?>
                                        <input type="text" name="npsn" class="form-control" id="npsn" value="<?= ($mode == 'edit') ? $data->npsn : '' ?>" autocomplete="off" required <?= ($mode == 'edit') ? 'readonly' : '' ?>>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="sekolah">Sekolah</label>
                                        <?php if(session()->has('validasi') && isset(session('validasi')['sekolah'])): ?>
                                        <small class="text-danger"><?= session('validasi')['sekolah'] ?></small>
                                        <?php endif ?>
                                        <input type="text" name="sekolah" class="form-control" id="sekolah" value="<?= ($mode == 'edit') ? $data->sekolah : '' ?>" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <?php if(session()->has('validasi') && isset(session('validasi')['alamat'])): ?>
                                <small class="text-danger"><?= session('validasi')['alamat'] ?></small>
                                <?php endif ?>
                                <textarea name="alamat" class="form-control" id="alamat" required><?= ($mode == 'edit') ? $data->alamat : '' ?></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-success">
                                    <span>Simpan</span>
                                    <i class="fas fa-save"></i>
                                </button>
                                <a href="<?= site_url('sekolah') ?>" class="btn btn-sm btn-warning">
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

<?= $this->section('content-js') ?>
<script>
    <?php if($mode == 'edit'): ?>
    window.addEventListener('load', async function(){
        await onClickKabupaten();
        document.getElementById('kecamatan').value = '<?= $data->idkecamatan ?>';
    })
    <?php endif ?>

    async function onClickKabupaten(){
        let kabSelect = document.getElementById('kabupaten').value;

        let url = '<?= site_url('api/get-list-kecamatan') ?>';
        const headers = new Headers({
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        });

        let response = await fetch(url, {
            method: 'POST',
            headers: headers,
            body: JSON.stringify({"kabupaten": kabSelect})
        });
        let code = response.status;
        let res = await response.json();
        if(code !== 200){
            return;

        }

        let data = res['data'];
        let html = '';
        data.forEach(kecamatan => {
            html += `<option value="${kecamatan.idkecamatan}">${kecamatan.kecamatan}</option>`;
        });
        document.getElementById('kecamatan').innerHTML = html;
    }
</script>
<?= $this->endSection() ?>
