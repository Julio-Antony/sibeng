<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> Stock</h1>
            </div><!-- /.col -->
            <div class="offset-sm-5 col-sm-1">
                <a href="<?= site_url('stock/stock_out') ?>" class="btn btn-info">Back</a>
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
                    <form class="form-horizontal" action="<?= site_url('stock/process_stock_out') ?>" method="POST">
                        <div class="form-group row">
                            <label for="date" class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="date" name="date" value="<?= date('Y-m-d') ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="barcode" class="col-sm-2 col-form-label">Barcode</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="hidden" name="item_id" id="item_id">
                                    <input type="text" class="form-control" id="barcode" name="barcode" required>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-info " data-toggle="modal" data-target="#modal-item">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="item_name" class="col-sm-2 col-form-label">Item Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="item_name" name="item_name" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="unit_name" class="col-sm-2 col-form-label">Item Unit</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="unit_name" name="unit_name" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="initial_stock" class="col-sm-2 col-form-label">Initial Stock</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="initial_stock" name="initial_stock" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="detail" class="col-sm-2 col-form-label">Detail</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="detail" name="detail" placeholder="tambahan / etc" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="supplier" class="col-sm-2 col-form-label">Supplier</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="supplier" name="supplier" required>
                                    <option value="">- Pilih -</option>
                                    <?php foreach ($supplier as $i => $data) {
                                        echo '<option value="' . $data->supplier_id . '">' . $data->supplier_name . '</option>';
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="qty" class="col-sm-2 col-form-label">Qty</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="qty" name="qty" required>
                            </div>
                        </div>
                </div>
                <div class="form-group row ">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" name="in_add" class="btn btn-primary">Submit</button>
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

<div class="modal fade" id="modal-item">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Select Product Item</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered table-strped text-xs" id="table-1">
                    <thead>
                        <tr>
                            <th>Barcode</th>
                            <th>Name</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($item as $i => $data) {  ?>
                            <tr>
                                <td><?= $data->barcode ?></td>
                                <td><?= $data->item_name ?></td>
                                <td><?= $data->unit_name ?></td>
                                <td><?= indo_currency($data->price) ?></td>
                                <td><?= $data->stock ?></td>
                                <td>
                                    <button class="btn btn-primary btn-xs" id="select" data-id="<?= $data->item_id ?>" data-barcode="<?= $data->barcode ?>" data-item_name="<?= $data->item_name ?>" data-unit_name="<?= $data->unit_name ?>" data-stock="<?= $data->stock ?>">
                                        <i class="fa fa-check"></i> Select
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).on('click', '#select', function() {
            var item_id = $(this).data('id');
            var barcode = $(this).data('barcode');
            var item_name = $(this).data('item_name');
            var unit_name = $(this).data('unit_name');
            var stock = $(this).data('stock');
            $('#item_id').val(item_id);
            $('#barcode').val(barcode);
            $('#item_name').val(item_name);
            $('#unit_name').val(unit_name);
            $('#initial_stock').val(stock);
            $('#modal-item').modal('hide');
        })
    })
</script>