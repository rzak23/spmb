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
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">Daftar Sekolah</h6>
                            <div class="card-tools">
                                <a href="<?= site_url('sekolah/add') ?>" class="btn btn-sm btn-success">
                                    <span>Tambah</span>
                                    <i class="fas fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>NPSN</th>
                                    <th>Sekolah</th>
                                    <th>Region</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($data as $row): ?>
                                <tr>
                                    <td><?= $row->npsn ?></td>
                                    <td><?= $row->sekolah ?></td>
                                    <td><?= "{$row->kabupaten} - {$row->kecamatan}" ?></td>
                                    <td class="text-center">
                                        <a href="<?= site_url('sekolah/edit/'.$row->npsn) ?>">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= site_url('sekolah/hapus/'.$row->npsn) ?>">
                                            <i class="fas fa-trash"></i>
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
        </div>
    </section>
</div>
<?= $this->endSection() ?>
