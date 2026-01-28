<?php
/**
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

                    <?php if(session()->has('success')): ?>
                    <div class="alert alert-success"><?= session('success') ?></div>
                    <?php endif ?>
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">Daftar Siswa</h6>
                            <?php if(!session()->get('is_admin')): ?>
                            <div class="card-tools">
                                <a href="<?= site_url('siswa/add') ?>" class="btn btn-sm btn-success">
                                    <span>Tambah</span>
                                    <i class="fas fa-plus"></i>
                                </a>
                                <a href="" class="btn btn-sm btn-primary">
                                    <span>Import File Excel</span>
                                    <i class="fas fa-file-excel"></i>
                                </a>
                            </div>
                            <?php endif ?>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>NIP</th>
                                    <th>Siswa</th>
                                    <th>Sekolah</th>
                                    <th>Status</th>
                                    <th>Verifikasi</th>
                                    <th>#</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($data as $row): ?>
                                    <tr>
                                        <td><?= $row->nip ?></td>
                                        <td><?= $row->nama_siswa ?></td>
                                        <td><?= $row->sekolah ?></td>
                                        <td><?= status_siswa($row->status) ?></td>
                                        <td class="<?= ($row->is_verify) ? 'bg-success' : 'bg-danger' ?>">
                                            <?= ($row->is_verify) ? 'Sudah Diverifikasi' : 'Belum Diverifikasi' ?>
                                        </td>
                                        <td class="text-center"></td>
                                    </tr>
                                <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
