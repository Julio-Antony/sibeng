<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Stock out data</h1>
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
                        <h3 class="card-title">Stock Out</h3>
                        <div class="float-right">
                            <a href="<?= site_url('stock/stock_out_add') ?>" class="btn btn-primary btn-flat btn-sm">
                                <i class="fa fa-plus"></i>
                                Add Stock out
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-1">
                        <table class="table table-bordered text-center" id="table-1">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Barcode</th>
                                    <th>Product Item</th>
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
                                        <td><?= $data->barcode ?></td>
                                        <td><?= $data->item_name ?></td>
                                        <td><?= $data->qty ?></td>
                                        <td><?= indo_date($data->date) ?></td>
                                        <td>
                                            <a href="javascript;" class="btn btn-info btn-flat btn-xs" id="detail-button" data-toggle="modal" data-target="#modal-detail" data-image="<?= $data->image ?>" data-barcode="<?= $data->barcode ?>" data-item_name="<?= $data->item_name ?>" data-detail="<?= $data->detail ?>" data-supplier_name="<?= $data->supplier_name ?>" data-qty="<?= $data->qty ?>" data-date="<?= indo_date($data->date) ?>">
                                                <i class="fas fa-eye"></i>
                                                detail
                                            </a>
                                            <!-- <a href="<?= site_url('stock/stock_out_delete/' . $data->stock_id . '/' . $data->item_id) ?>" onclick="return confirm('yakin hapus data?')" class="btn btn-danger btn-flat btn-xs">
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </a> -->
                                            <a href="#modalDelete" data-toggle="modal" onclick="$('#modalDelete #form-delete').attr('action','<?= site_url('stock/stock_out_delete/' . $data->stock_id . '/' . $data->item_id) ?>')" class="btn btn-danger btn-flat btn-xs">
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
            <div class="modal-header" style="background-color: aqua;">
                <h2 class="modal-title ml-auto" id="item_name"></h2>
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
                                <dt class="col-sm-6">Barcode</dt>
                                <dd class="col-sm-6" id="barcode"></dd>
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

<!-- Modal -->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Yakin hapus data ?
            </div>
            <div class="modal-footer">
                <form id="form-delete" action="" method="POST">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).on('click', '#detail-button', function() {
            var image = $(this).data('image');
            var barcode = $(this).data('barcode');
            var item_name = $(this).data('item_name');
            var detail = $(this).data('detail');
            var supplier_name = $(this).data('supplier_name');
            var qty = $(this).data('qty');
            var date = $(this).data('date');
            $('#image').prop('src', 'assets/dist/img/product/' + image);
            $('#barcode').text(barcode);
            $('#item_name').text(item_name);
            $('#detail').text(detail);
            $('#supplier_name').text(supplier_name);
            $('#qty').text(qty);
            $('#date').text(date);
            $('#modal-detail').modal('hide');
        })
    })
</script>