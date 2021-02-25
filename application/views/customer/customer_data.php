<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Customer data</h1>
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
                        <h3 class="card-title">customer list</h3>
                        <div class="float-right">
                            <a href="<?= site_url('customer/add') ?>" class="btn btn-primary btn-flat btn-sm">
                                <i class="fa fa-user-plus"></i>
                                Add customer
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
                                    <th>Gender</th>
                                    <th>phone</th>
                                    <th>Address</th>
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
                                        <td><?= $data->customer_name ?></td>
                                        <td><?= $data->gender ?></td>
                                        <td><?= $data->phone ?></td>
                                        <td><?= $data->address ?></td>
                                        <td><?= $data->created ?></td>
                                        <td><?= $data->updated ?></td>
                                        <td>
                                            <a href="<?= site_url('customer/edit/' . $data->customer_id) ?>" class="btn btn-success btn-flat btn-xs">
                                                <i class="fas fa-pencil-alt"></i>
                                                Edit
                                            </a>
                                            <a href="<?= site_url('customer/delete/' . $data->customer_id) ?>" onclick="return confirm('yakin hapus data?')" class="btn btn-danger btn-flat btn-xs">
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