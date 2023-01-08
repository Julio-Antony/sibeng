<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">product data</h1>
            </div>
            <div class="col-sm-4 offset-sm-2">
                <?php $this->view('message') ?>
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
                    <div class="card-header bg-dark">
                        <h3 class="card-title">product item</h3>
                        <div class="float-right">
                            <a href="<?= site_url('sparepart/add') ?>" class="btn btn-danger btn-flat btn-sm">
                                <i class="fa fa-plus"></i>
                                Tambah Sparepart
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-1">
                        <table class="table table-bordered text-center" id="table-1">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Image</th>
                                    <th>Part Number</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($row->result() as $key => $data) { ?>
                                    <tr>
                                        <td><?= $no++ ?>.</td>
                                        <td>
                                            <?php if ($data->image != null) { ?>
                                                <img src="<?= base_url('assets/dist/img/sparepart/' . $data->image) ?>" width="45" height="45">
                                            <?php } ?>
                                        </td>
                                        <td><?= $data->part_number ?></td>
                                        <td><?= $data->sparepart_name ?></td>
                                        <td><?= $data->price ?></td>
                                        <td><?= $data->stock ?></td>
                                        <td>
                                            <a href="<?= site_url('sparepart/edit/' . $data->sparepart_id) ?>" class="btn btn-success btn-flat btn-xs">
                                                <i class="fas fa-pencil-alt"></i>
                                                Edit
                                            </a>
                                            <a href="<?= site_url('sparepart/delete/' . $data->sparepart_id) ?>" onclick="return confirm('yakin hapus data?')" class="btn btn-danger btn-flat btn-xs">
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