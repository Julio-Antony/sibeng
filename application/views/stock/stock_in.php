<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Riwayat Stock In Sparepart</h1>
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
                        <h3 class="card-title">Stock In</h3>
                        <div class="float-right">
                            <a href="<?= site_url('stock/stock_in_add') ?>" class="btn btn-danger btn-flat btn-sm">
                                <i class="fa fa-plus"></i>
                                Tambah Stock
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-1">
                        <table class="table table-bordered text-center" id="table-1">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Part Number</th>
                                    <th>Nama Sparepart</th>
                                    <th>Qty</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($row as $key => $data) { ?>
                                    <tr>
                                        <td style="width:5%;"><?= $no++ ?>.</td>
                                        <td><?= $data->part_number ?></td>
                                        <td><?= $data->product_name ?></td>
                                        <td><?= $data->qty ?></td>
                                        <td><?= indo_date($data->date) ?></td>
                                        <td>
                                            <a href="javascript;" class="btn btn-info btn-flat btn-xs" id="detail-button" data-toggle="modal" data-target="#modal-detail" data-image="<?= $data->image ?>" data-part_number="<?= $data->part_number ?>" data-product_name="<?= $data->product_name ?>" data-detail="<?= $data->detail ?>" data-supplier_name="<?= $data->supplier_name ?>" data-qty="<?= $data->qty ?>" data-date="<?= indo_date($data->date) ?>">
                                                <i class="fas fa-eye"></i>
                                                detail
                                            </a>
                                            <a href="<?= site_url('stock/stock_in_delete/' . $data->stock_id . '/' . $data->product_id) ?>" onclick="return confirm('yakin hapus data?')" class="btn btn-danger btn-flat btn-xs">
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

<div class="modal fade" id="modal-detail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <p class="modal-title ml-auto" id="product_name"></p>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-5">
                            <img id="image" style="
                            max-width: 100%;
                            height: auto;
                            border-radius: 8px;">
                        </div>
                        <div class="col-md-7">
                            <dl class="row">
                                <dt class="col-sm-6">Part Number</dt>
                                <dd class="col-sm-6" id="part_number"></dd>
                                <dt class="col-sm-6">Detail</dt>
                                <dd class="col-sm-6" id="detail"></dd>
                                <dt class="col-sm-6">Supplier Name</dt>
                                <dd class="col-sm-6" id="supplier_name"></dd>
                                <dt class="col-sm-6">Qty</dt>
                                <dd class="col-sm-6" id="qty"></dd>
                                <dt class="col-sm-6">Date</dt>
                                <dd class="col-sm-6" id="date"></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).on('click', '#detail-button', function() {
            var image = $(this).data('image');
            var part_number = $(this).data('part_number');
            var product_name = $(this).data('product_name');
            var detail = $(this).data('detail');
            var supplier_name = $(this).data('supplier_name');
            var qty = $(this).data('qty');
            var date = $(this).data('date');
            $('#image').attr('src', '<?php echo base_url() ?>assets/dist/img/sparepart/' + image);
            $('#part_number').text(part_number);
            $('#product_name').text(product_name);
            $('#detail').text(detail);
            $('#supplier_name').text(supplier_name);
            $('#qty').text(qty);
            $('#date').text(date);
            $('#modal-detail').modal('hide');
        })
    })
</script>