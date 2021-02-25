<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?= ucfirst($page) ?> unit</h1>
            </div><!-- /.col -->
            <div class="offset-sm-5 col-sm-1">
                <a href="<?= site_url('product') ?>" class="btn btn-info">Back</a>
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
                    <form class="form-horizontal" action="<?= site_url('product/process_unit') ?>" method="POST">
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">unit Name</label>
                            <div class="col-sm-10">
                                <input type="hidden" name="id" value="<?= $row->unit_id ?>">
                                <input type="text" class="form-control" name="unit_name" value="<?= $row->unit_name ?>" placeholder="unit Name" required>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="offset-sm-2 col-sm-10">
                                <button type="submit" name="<?= $page ?>" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-warning">reset</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.tab-pane -->
            </div>
        </div>
    </div>
</section>