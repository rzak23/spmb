<?php
/**
 * @var object $data
 */
?>
<?= $this->extend('layout/dashboard_layout') ?>

<?= $this->section('content-css') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.3.0/css/fixedColumns.bootstrap4.min.css">
<?= $this->endSection() ?>

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
                                <a href="<?= site_url('siswa/batch') ?>" class="btn btn-sm btn-primary">
                                    <span>Import File Excel</span>
                                    <i class="fas fa-file-excel"></i>
                                </a>
                            </div>
                            <?php endif ?>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tableSiswa" class="table table-bordered table-striped nowrap" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Sekolah</th>
                                        <th>NISN</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>No. KK</th>
                                        <th>No. PKH</th>
                                        <th>No. PIP</th>
                                        <th>Ibu Kandung</th>
                                        <th>Tempat Lahir</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Alamat</th>
                                        <th>Desa</th>
                                        <th>Kabupaten</th>
                                        <th>Kecamatan</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Status</th>
                                        <th>Verifikasi</th>
                                        <th>#</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($data as $row): ?>
                                       <tr>
                                           <td><?= $row->sekolah ?></td>
                                           <td><?= $row->nisn ?></td>
                                           <td><?= $row->nama_siswa ?></td>
                                           <td><?= $row->nik ?></td>
                                           <td><?= $row->nomor_kk ?></td>
                                           <td><?= $row->nomor_pkh ?></td>
                                           <td><?= $row->nomor_pip ?></td>
                                           <td><?= $row->ibu_kandung ?></td>
                                           <td><?= $row->tempat_lahir ?></td>
                                           <td><?= $row->tanggal_lahir ?></td>
                                           <td><?= $row->alamat ?></td>
                                           <td><?= $row->desa ?></td>
                                           <td><?= $row->kabupaten ?></td>
                                           <td><?= $row->kecamatan ?></td>
                                           <td class="text-center"><?= nama_jk($row->jk) ?></td>
                                           <td class="text-center"><?= strtoupper($row->status) ?></td>
                                           <td class="<?= ($row->is_verify) ? 'bg-success' : 'bg-danger' ?>">
                                               <?= ($row->is_verify) ? 'Sudah Diverifikasi' : 'Belum Diverifikasi' ?>
                                           </td>
                                           <td class="text-center">
                                               <a href="<?= site_url('siswa/edit/'.$row->idsiswa) ?>" class="btn btn-sm btn-info">
                                                   <i class="fas fa-edit"></i>
                                               </a>
                                               <a href="<?= site_url('siswa/hapus/'.$row->idsiswa) ?>" class="btn btn-sm btn-danger">
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
        </div>
    </section>
</div>
<?= $this->endSection() ?>

<?= $this->section('content-js') ?>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tableSiswa').DataTable({
            scrollX: true,
            scrollY: '400px',
            scrollCollapse: true,
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            fixedColumns: {
                leftColumns: 2,  // Freeze kolom Sekolah & NISN
                rightColumns: 1  // Freeze kolom Action
            },
            language: {
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Data tidak ditemukan",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data yang tersedia",
                "infoFiltered": "(difilter dari _MAX_ total data)",
                "search": "Cari:",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            },
            columnDefs: [
                { width: '120px', targets: 0 }, // Sekolah
                { width: '100px', targets: 1 }, // NISN
                { width: '200px', targets: 2 }, // Nama
                { width: '150px', targets: 3 }, // NIK
                { width: '150px', targets: 10 }, // Alamat
                { width: '100px', targets: 17 }, // Action
                { orderable: false, targets: 17 } // Disable sorting di kolom action
            ]
        });
    });
</script>
<?= $this->endSection() ?>
