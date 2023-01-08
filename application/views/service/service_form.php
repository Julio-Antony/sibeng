<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?= ucfirst($page) ?> Data Service</h1>
            </div><!-- /.col -->
            <div class="offset-sm-5 col-sm-1">
                <a href="<?= site_url('sparepart') ?>" class="btn btn-danger">Kembali</a>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-8">
                <?php $this->view('message') ?>
                <div class="tab-pane" id="settings">
                    <?= form_open_multipart('service/process') ?>
                    <div class="form-group row">
                        <label for="service_name" class="col-sm-2 col-form-label">Nama Service</label>
                        <div class="col-sm-10">
                            <input type="hidden" name="id" value="<?= $row->service_id ?>">
                            <input type="text" class="form-control" id="service_name" name="service_name" value="<?= $row->service_name ?>" placeholder="Nama Service" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="price" name="price" value="<?= $row->price ?>" placeholder="Harga" required>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" name="<?= $page ?>" class="btn btn-danger">Submit</button>
                            <button type="reset" class="btn btn-dark">Reset</button>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
                <!-- /.tab-pane -->
            </div>
        </div>
    </div>
</section>