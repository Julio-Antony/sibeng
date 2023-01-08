<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?= ucfirst($page) ?> Data Sparepart</h1>
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
                    <?= form_open_multipart('sparepart/process') ?>
                    <div class="form-group row">
                        <label for="part_number" class="col-sm-2 col-form-label">Part Number</label>
                        <div class="col-sm-10">
                            <input type="hidden" name="id" value="<?= $row->sparepart_id ?>">
                            <input type="text" class="form-control" id="part_number" name="part_number" value="<?= $row->part_number ?>" placeholder="Part Number" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sparepart_name" class="col-sm-2 col-form-label">Nama Sparepart</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="sparepart_name" name="sparepart_name" value="<?= $row->sparepart_name ?>" placeholder="Nama Sparepart" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="price" name="price" value="<?= $row->price ?>" placeholder="Harga" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-sm-2 col-form-label">Gambar</label>
                        <div class="col-sm-10">
                            <?php if ($page == 'Edit') {
                                if ($row->image != null) { ?>
                                    <div style="margin-bottom:5px">
                                        <img src="<?= base_url('assets/dist/img/sparepart/' . $row->image) ?>" width="300">
                                    </div>
                            <?php
                                }
                            } ?>
                            <input type="file" name="image" class="form-control">
                            <small>(Biarkan kosong jika tidak <?= $page == 'edit' ? 'diganti' : 'ada' ?>)</small>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" name="<?= $page ?>" class="btn btn-danger">Submit</button>
                            <button type="reset" class="btn btn-dark">reset</button>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
                <!-- /.tab-pane -->
            </div>
        </div>
    </div>
</section>