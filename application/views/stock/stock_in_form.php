<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> Stock</h1>
            </div><!-- /.col -->
            <div class="offset-sm-5 col-sm-1">
                <a href="<?= site_url('stock/stock_in_data') ?>" class="btn btn-danger">Kembali</a>
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
                    <form class="form-horizontal" action="<?= site_url('stock/process') ?>" method="POST">
                        <div class="form-group row">
                            <label for="date" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="date" name="date" value="<?= date('Y-m-d') ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="part_number" class="col-sm-2 col-form-label">Part Number</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="hidden" name="sparepart_id" id="sparepart_id">
                                    <input type="text" class="form-control" id="part_number" name="part_number" required>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#modal-item">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sparepart_name" class="col-sm-2 col-form-label">Nama Sparepart</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="sparepart_name" name="sparepart_name" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="initial_stock" class="col-sm-2 col-form-label">Stok Awal</label>
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
                        <button type="submit" name="in_add" class="btn btn-danger">Submit</button>
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

<div class="modal fade" id="modal-item">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pilih Sparepart</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered table-strped text-xs" id="table-1">
                    <thead>
                        <tr>
                            <th>Part Number</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Stock</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($item as $i => $data) {  ?>
                            <tr>
                                <td><?= $data->part_number ?></td>
                                <td><?= $data->sparepart_name ?></td>
                                <td><?= indo_currency($data->price) ?></td>
                                <td><?= $data->stock ?></td>
                                <td>
                                    <button class="btn btn-danger btn-xs" id="select" data-id="<?= $data->sparepart_id ?>" data-part_number="<?= $data->part_number ?>" data-sparepart_name="<?= $data->sparepart_name ?>" data-stock="<?= $data->stock ?>">
                                        <i class="fa fa-check"></i> Pilih
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
            var sparepart_id = $(this).data('id');
            var part_number = $(this).data('part_number');
            var sparepart_name = $(this).data('sparepart_name');
            var unit_name = $(this).data('unit_name');
            var stock = $(this).data('stock');
            $('#sparepart_id').val(sparepart_id);
            $('#part_number').val(part_number);
            $('#sparepart_name').val(sparepart_name);
            $('#initial_stock').val(stock);
            $('#modal-item').modal('hide');
        })
    })
</script>