<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">product data</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">product unit</h3>
                        <div class="float-right">
                            <a href="<?= site_url('product/add_unit') ?>" class="btn btn-primary btn-flat btn-sm">
                                <i class="fa fa-plus"></i>
                                Add unit
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-bordered text-center" id="table-1">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($row->result() as $key => $data) { ?>
                                    <tr>
                                        <td><?= $no++ ?>.</td>
                                        <td><?= $data->unit_name ?></td>
                                        <td><?= $data->created ?></td>
                                        <td><?= $data->updated ?></td>
                                        <td>
                                            <a href="<?= site_url('product/edit_unit/' . $data->unit_id) ?>" class="btn btn-success btn-flat btn-xs">
                                                <i class="fas fa-pencil-alt"></i>
                                                Edit
                                            </a>
                                            <a href="<?= site_url('product/delete_unit/' . $data->unit_id) ?>" onclick="return confirm('yakin hapus data?')" class="btn btn-danger btn-flat btn-xs">
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->