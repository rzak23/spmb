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
                            <h6 class="card-title"></h6>
                        </div>
                        <div class="card-body">
                            <?= form_open() ?>
                            <div class="form-group">
                                <label for="kabupaten">Nama Kabupaten</label>
                                <input type="text" name="kabupaten" class="form-control" id="kabupaten" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    <span>Simpan</span>
                                    <i class="fas fa-save"></i>
                                </button>
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
