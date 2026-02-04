<?php
/**
 * @var object $data
 */
?>
<?= $this->extend('layout/dashboard_layout') ?>

<?= $this->section('content-css') ?>
<style>
    #loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .spinner-wrapper {
        text-align: center;
        background: white;
        padding: 30px;
        border-radius: 10px;
    }

    .spinner-border {
        width: 3rem;
        height: 3rem;
    }

    .spinner-wrapper p {
        color: #333;
        font-weight: 500;
        margin: 0;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <div class="content-header"></div>

    <section class="content">
        <div class="container-fluid">
            <!-- Loading Overlay -->
            <div id="loading-overlay" style="display: none;">
                <div class="spinner-wrapper">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <p class="mt-3">Sedang memproses data, mohon tunggu...</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-info">
                        Gunakan File template yang sudah disediakan. Pastikan tidak merubah format pada file excel, perubahan format dan modifikasi struktur file excel dapat menyebabkan gagal proses
                    </div>
                    <?php if(session()->has('error')): ?>
                    <div class="alert alert-danger"><?= session('error') ?></div>
                    <?php endif ?>

                    <?php if(session()->has('success')): ?>
                    <div class="alert alert-success"><?= session('success') ?></div>
                    <?php endif ?>
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">Import Batch Data Siswa</h6>
                        </div>
                        <div class="card-body">
                            <a href="<?= site_url('siswa/download-template') ?>" class="btn btn-sm btn-primary mb-3" target="_blank">
                                <span>Download Template Excel</span>
                                <i class="fas fa-file-excel"></i>
                            </a>
                            <?= form_open_multipart('siswa/proses-batch', ['id' => 'form-upload']) ?>
                            <div class="form-group">
                                <label for="filesiswa">Upload File</label>
                                <?php if(session()->has('validasi') && isset(session('validasi')['filesiswa'])): ?>
                                    <small class="text-danger"><?= session('validasi')['filesiswa'] ?></small>
                                <?php endif ?>
                                <input type="file" name="filesiswa" class="form-control" id="filesiswa" accept="application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-success" id="btn-upload">
                                    <span>Upload</span>
                                    <i class="fas fa-upload"></i>
                                </button>
                            </div>
                            <?= form_close() ?>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h6 class="card-title">Daftar Data Siswa yang Tidak Valid</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>NISN</th>
                                    <th>Nama</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($data as $row): ?>
                                <tr>
                                    <td><?= $row->nisn ?></td>
                                    <td><?= $row->nama_siswa ?></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#error-detail" onclick="show_error(<?= $row->idfail ?>)">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </button>
                                        <a href="<?= site_url('siswa/edit/'.$row->idfail.'/fixed') ?>" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- modal show error -->
            <div class="modal fade" role="dialog" id="error-detail">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title">Daftar Kesalahan</h6>
                        </div>
                        <div class="modal-body">
                            <label for="err-detail">Data yang perlu diperbaiki</label>
                            <textarea name="err-detail" class="form-control" id="err-detail" readonly></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal show error -->
        </div>
    </section>
</div>
<?= $this->endSection() ?>

<?= $this->section('content-js') ?>
<script>
    // Handle form submit dengan loading
    document.getElementById('form-upload').addEventListener('submit', function(e) {
        const fileInput = document.getElementById('filesiswa');
        // Validasi file sudah dipilih
        if (!fileInput.files.length) {
            e.preventDefault();
            alert('Silakan pilih file terlebih dahulu');
            return false;
        }

        // Tampilkan loading overlay
        document.getElementById('loading-overlay').style.display = 'flex';
        // Disable tombol upload
        document.getElementById('btn-upload').disabled = true;
    });

    async function show_error(id){
        let url = `<?= site_url('api/show-error-import') ?>/${id}`;
        const headers = {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }

        let response = await fetch(url, {
            method: 'GET',
            headers: headers
        });

        let code = response.status;
        let res = await response.json();
        if(code !== 200){
            window.alert(res['msg']);
            return;
        }

        let data = res['data'];
        document.getElementById('err-detail').value = data['json_fail'];
    }
</script>
<?= $this->endSection() ?>
