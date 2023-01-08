<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?= ucfirst($page) ?> Supplier</h1>
            </div><!-- /.col -->
            <div class="offset-sm-5 col-sm-1">
                <a href="<?= site_url('supplier') ?>" class="btn btn-danger">Kembali</a>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-8">
                <div class="tab-pane" id="settings">
                    <form class="form-horizontal" action="<?= site_url('supplier/process') ?>" method="POST">
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Nama Supplier</label>
                            <div class="col-sm-10">
                                <input type="hidden" name="id" value="<?= $row->supplier_id ?>">
                                <input type="text" class="form-control" name="supplier_name" value="<?= $row->supplier_name ?>" placeholder="Nama Supplier" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">No. HP</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="phone" value="<?= $row->phone ?>" placeholder="No. HP" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Deskripsi</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="description" placeholder="Deskripsi"><?= $row->description ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="address" placeholder="Alamat" required><?= $row->address ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="offset-sm-2 col-sm-10">
                                <button type="submit" name="<?= $page ?>" class="btn btn-danger">Submit</button>
                                <button type="reset" class="btn btn-dark">reset</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.tab-pane -->
            </div>
        </div>
    </div>
</section>