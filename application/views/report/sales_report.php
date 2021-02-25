<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">report data</h1>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">report list</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-1">
                        <table class="table table-bordered text-center" id="table-1">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Invoice</th>
                                    <th>Date</th>
                                    <th>Customer</th>
                                    <th>Total</th>
                                    <th>Discount</th>
                                    <th>Grand Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($row->result() as $key => $data) { ?>
                                    <tr>
                                        <td><?= $no++ ?>.</td>
                                        <td><?= $data->invoice ?></td>
                                        <td><?= indo_date($data->date) ?></td>
                                        <td><?= $data->customer_id == null ? "Umum" : $data->customer_name ?></td>
                                        <td><?= indo_currency($data->total_price) ?></td>
                                        <td><?= indo_currency($data->discount) ?></td>
                                        <td><?= indo_currency($data->final_price) ?></td>
                                        <td>
                                            <button id="detail" class="btn btn-default btn-flat btn-xs" data-toggle="modal" data-target="#report_detail" data-invoice="<?= $data->invoice ?>" data-date="<?= indo_date($data->date) ?>" data-time="<?= substr($data->created, 11, 5) ?>" data-customer="<?= $data->customer_id == null ? "Umum" : $data->customer_name ?>" data-total="<?= indo_currency($data->total_price) ?>" data-discount="<?= indo_currency($data->discount) ?>" data-grandtotal="<?= indo_currency($data->final_price) ?>" data-cash="<?= indo_currency($data->cash) ?>" data-remaining="<?= indo_currency($data->remaining) ?>" data-note="<?= $data->note ?>" data-cashier="<?= ucfirst($data->username) ?>" data-saleid="<?= $data->sales_id ?>">
                                                <i class=" fa fa-eye"></i> Detail
                                            </button>
                                            <a href="<?= site_url('transaction/print/' . $data->sales_id) ?>" target="_blank" class="btn btn-success btn-flat btn-xs">
                                                <i class="fas fa-print"></i>
                                                Print
                                            </a>
                                            <a href="<?= site_url('transaction/delete_sales/' . $data->sales_id) ?>" onclick="return confirm('yakin hapus data?')" class="btn btn-danger btn-flat btn-xs">
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

<div class="modal fade" id="report_detail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sales Report Detail</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered no-margin">
                    <tbody>
                        <tr>
                            <th style="width:20%">Invoice</th>
                            <td style="width:30%"><span id="invoice"></span></td>
                            <th style="width:20%">Customer</th>
                            <td style="width:30%"><span id="cust"></span></td>
                        </tr>
                        <tr>
                            <th>Date Time</th>
                            <td><span id="datetime"></span></td>
                            <th>Cashier</th>
                            <td><span id="cashier"></span></td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td><span id="total"></alspan>
                            </td>
                            <th>Cash</th>
                            <td><span id="cash"></span></td>
                        </tr>
                        <tr>
                            <th>Discount</th>
                            <td><span id="discount"></span></td>
                            <th>Change</th>
                            <td><span id="change"></span></td>
                        </tr>
                        <tr>
                            <th>Grand Total</th>
                            <td><span id="grandtotal"></span></td>
                            <th>Note</th>
                            <td><span id="note"></span></td>
                        </tr>
                        <tr>
                            <th>Product</th>
                            <td colspan="3"><span id="product"></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '#detail', function() {
        $('#invoice').text($(this).data('invoice'))
        $('#cust').text($(this).data('customer'))
        $('#datetime').text($(this).data('date') + ' ' + $(this).data('time'))
        $('#total').text($(this).data('total'))
        $('#discount').text($(this).data('discount'))
        $('#cash').text($(this).data('cash'))
        $('#change').text($(this).data('remaining'))
        $('#grandtotal').text($(this).data('grandtotal'))
        $('#note').text($(this).data('note'))
        $('#cashier').text($(this).data('cashier'))

        var product = '<table class="table no-margin">'
        product += '<tr><th>Item</th><th>Price</th><th>Qty</th><th>Disc</th><th>Total</th></tr>'
        $.getJSON('<?= site_url('report/sales_detail/') ?>' + $(this).data('saleid'), function(data) {
            $.each(data, function(key, val) {
                product += '<tr><td>' + val.item_name + '</td><td>' + val.price + '</td><td>' + val.qty + '</td><td>' + val.discount_item + '</td><td>' + val.total + '</td></tr>'
            })
            product += '</table>'
            $('#product').html(product)
        })
    })
</script>