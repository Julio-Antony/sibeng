<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">product data</h1>
            </div>
            <div class="col-sm-4">
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
                    <div class="card-header">
                        <h3 class="card-title">product item</h3>
                        <div class="float-right">
                            <a href="<?= site_url('product/add_item') ?>" class="btn btn-primary btn-flat btn-sm">
                                <i class="fa fa-plus"></i>
                                Add item
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
                                    <th>Barcode</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <?php $no = 1;
                                        foreach ($row->result() as $key => $data) { ?>
                                    <tr>
                                        <td><?= $no++ ?>.</td>
                                        <td>
                                            <?php if ($data->image != null) { ?>
                                                <img src="<?= base_url('assets/dist/img/product/' . $data->image) ?>" width="45" height="45">
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?= $data->barcode ?>
                                            <br>
                                            <a href="<?= site_url('product/barcode_generator/' . $data->item_id) ?>" class="btn btn-success btn-flat btn-xs">
                                                Generate Barcode
                                                <i class="fas fa-barcode"></i>
                                            </a>
                                        </td>
                                        <td><?= $data->item_name ?></td>
                                        <td><?= $data->price ?></td>
                                        <td><?= $data->created ?></td>
                                        <td><?= $data->updated ?></td>
                                        <td>
                                            <a href="<?= site_url('product/edit_item/' . $data->item_id) ?>" class="btn btn-success btn-flat btn-xs">
                                                <i class="fas fa-pencil-alt"></i>
                                                Edit
                                            </a>
                                            <a href="<?= site_url('product/delete_item/' . $data->item_id) ?>" onclick="return confirm('yakin hapus data?')" class="btn btn-danger btn-flat btn-xs">
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                        } ?> -->
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

<script>
    $(document).ready(function() {
        $('#table-1').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('product/get_ajax') ?>",
                "type": "POST"
            },
            "columnDefs": [{
                "targets": [0, 1, 7],
                "orderable": false
            }]
        })
    })
</script>