<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?= ucfirst($page) ?> customer</h1>
            </div><!-- /.col -->
            <div class="offset-sm-5 col-sm-1">
                <a href="<?= site_url('customer') ?>" class="btn btn-info">Back</a>
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
                    <form class="form-horizontal" action="<?= site_url('customer/process') ?>" method="POST">
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">customer Name</label>
                            <div class="col-sm-10">
                                <input type="hidden" name="id" value="<?= $row->customer_id ?>">
                                <input type="text" class="form-control" name="customer_name" value="<?= $row->customer_name ?>" placeholder="Name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Gender</label>
                            <div class="col-sm-10">
                                <select name="gender" class="form-controll" required>
                                    <option value="">- Pilih Gender -</option>
                                    <option value="Laki-laki" <?= $row->gender == 'Laki=laki' ? 'selected' : null ?>>Laki-laki</option>
                                    <option value="Perempuan" <?= $row->gender == 'Perempuan' ? 'selected' : null ?>>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="phone" value="<?= $row->phone ?>" placeholder="Phone" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="address" placeholder="Address" required><?= $row->address ?></textarea>
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