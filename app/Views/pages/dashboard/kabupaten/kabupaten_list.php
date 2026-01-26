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
                            <h6 class="card-title">Daftar Kabupaten</h6>
                            <div class="card-tools">
                                <a href="<?= site_url('kabupaten/add') ?>" class="btn btn-sm btn-success">
                                    <span>Tambah</span>
                                    <i class="fas fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Kabupaten</th>
                                    <th>#</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($data as $row): ?>
                                <tr>
                                    <td><?= $row->kabupaten ?></td>
                                    <td class="text-center">
                                        <a href="<?= site_url('kabupaten/edit/'.$row->idkabupaten) ?>" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= site_url('kabupaten/hapus/'.$row->idkabupaten) ?>" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
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
