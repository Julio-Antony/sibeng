<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Sales</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Cashier</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table width="100%">
                            <tr>
                                <td style="vertical-align: top;">
                                    <label for="date">Date</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="date" id="date" value="<?= date('Y-m-d') ?>" class="form-control">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align:top; width:30;">
                                    <label for="user">Kasir</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" id="user" value="<?= $this->fungsi->user_login()->username ?>" class="form-control" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align:top">
                                    <label for="customer">Customer</label>
                                </td>
                                <td>
                                    <div>
                                        <select id="customer" class="form-control">
                                            <option value="">Umum</option>
                                            <?php foreach ($customer as $cust => $value) {
                                                echo '<option value="' . $value->customer_id . '">' . $value->customer_name . '</option>';
                                            } ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Product Count</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table width="100%">
                            <tr>
                                <td style="vertical-align: top; width: 30%">
                                    <label for="barcode">Barcode</label>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="hidden" id="item_id">
                                        <input type="hidden" id="price">
                                        <input type="hidden" id="stock">
                                        <input type="hidden" id="qty_cart">
                                        <input type="text" id="barcode" class="form-control" autofocus>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal-item">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align:top">
                                    <label for="qty">Qty</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" id="qty" value="1" min="1" class="form-control">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div>
                                        <button type="button" id="add-chart" class="btn btn-primary">
                                            <i class="fa fa-cart-plus"></i> Add
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Payment ID</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4>Invoice <b><span id="invoice"><?= $invoice ?></span></b></h4>
                        <h1><b><span id="grand_total_2" style="font-size:50pt">0</span></b></h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Product List</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Barcode</th>
                                    <th>Product Item</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th width="15%">Discount Item</th>
                                    <th width="15%">Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="cart_table">
                                <?php $this->view('transaction/cart_data'); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Price</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table width="100%">
                            <tr>
                                <td style="vertical-align:top; width:30%;">
                                    <label for="subtotal">Subtotal</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" id="subtotal" value="" class="form-control" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top;">
                                    <label for="discount">Discount</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" id="discount_2" value="0" min="0" class="form-control">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top;">
                                    <label for="grand-total">Grand total</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" id="grand_total" class="form-control" readonly>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Payment type</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table width="100%">
                            <tr>
                                <td style="vertical-align:top; width:30%;">
                                    <label for="cash">Cash</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" id="cash" value="0" min="0" class="form-control">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top;">
                                    <label for="change">Change</label>
                                </td>
                                <td>
                                    <div>
                                        <input type="number" id="change" class="form-control" readonly>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Detail</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table width="100%">
                            <tr>
                                <td style="vertical-align:top; width:30%;">
                                    <label for="note">Note</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <textarea id="note" rows="3" class="form-control"></textarea>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <button id="cancel_payment" class="btn btn-warning btn-flat">
                        <i class="fa fa-refresh"></i>Cancel
                    </button>
                    <button id="process_payment" class="btn btn-primary btn-flat">
                        <i class="fa fa-paper-plane-o"></i>Process payment
                    </button>
                </div>
                </td>
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
                                    <button class="btn btn-primary btn-xs" id="select" data-id="<?= $data->item_id ?>" data-barcode="<?= $data->barcode ?>" data-item_name="<?= $data->item_name ?>" data-price="<?= $data->price ?>" data-stock="<?= $data->stock ?>">
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

<!-- Modal Edit -->
<div class="modal fade" id="modal-item-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Product Item</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="cart_id_item">
                <div class="form-group">
                    <label for="product_item">Product Item</label>
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" id="barcode_item" class="form-control" readonly>
                        </div>
                        <div class="col-md-7">
                            <input type="text" id="product_item" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="price_item">Price Item</label>
                    <input type="number" id="price_item" min="0" class="form-control">
                </div>
                <div class="form-group">
                    <label for="qty_item">Qty Item</label>
                    <div class="row">
                        <div class="col-md-7">
                            <input type="number" id="qty_item" min="1" class="form-control">
                        </div>
                        <div class="col-md-5">
                            <input type="number" id="stock_item" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="total_before">Total Before Discount</label>
                        <input type="number" id="total_before" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="discount_item">Discount per Item</label>
                        <input type="number" id="discount_item" min="0" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="total_item">Total After Discount</label>
                        <input type="number" id="total_item" class="form-control" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-right">
                        <button id="edit_cart" class="btn btn-flat btn-success">
                            <i class="fa fa-paper-plane"></i> Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).on('click', '#select', function() {
            $('#item_id').val($(this).data('id'))
            $('#barcode').val($(this).data('barcode'))
            $('#price').val($(this).data('price'))
            $('#stock').val($(this).data('stock'))
            $('#modal-item').modal('hide')

            get_cart_qty($(this).data('barcode'))
        })

        function get_cart_qty(barcode) {
            $('#cart_table tr').each(function() {
                // var qty_cart = $(this).find("td").eq(4).html()
                var qty_cart = $("#cart_table td.barcode:contains('" + barcode + "')").parent().find("td").eq(4).html()
                if (qty_cart != null) {
                    $('#qty_cart').val(qty_cart)
                } else {
                    $('#qty_cart').val(0)
                }
            });
        }

        $(document).on('click', '#add-chart', function() {
            var item_id = $('#item_id').val()
            var price = $('#price').val()
            var stock = $('#stock').val()
            var qty = $('#qty').val()
            var qty_cart = $('#qty_cart').val()
            if (item_id == '') {
                alert('Product belum dipilih')
                $('#barcode').focus()
            } else if (stock < 1 || parseInt(stock) < (parseInt(qty_cart) + parseInt(qty))) {
                alert('Stock tidak mencukupi')
                $('#qty').focus()
            } else {
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('transaction/process') ?>',
                    data: {
                        'add_cart': true,
                        'item_id': item_id,
                        'price': price,
                        'qty': qty
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.success == true) {
                            $('#cart_table').load('<?= site_url('transaction/cart_data') ?>', function() {
                                calculate()
                            })
                            $('#item_id').val('')
                            $('#barcode').val('')
                            $('#qty').val(1)
                            $('#barcode').focus()
                        } else {
                            alert('Gagal tambah item ke db')
                        }
                    }
                })
            }
        })

        $(document).on('click', '#delete_cart', function() {
            if (confirm('Apakah yakin ?')) {
                var cart_id = $(this).data('cart_id')
                $.ajax({

                    type: 'POST',
                    url: '<?= site_url('transaction/cart_delete') ?>',
                    dataType: 'json',
                    data: {
                        'cart_id': cart_id
                    },
                    success: function(result) {
                        if (result.success == true) {
                            $('#cart_table').load('<?= site_url('transaction/cart_data') ?>', function() {
                                calculate()
                            })
                        } else {
                            alert('Gagal hapus cart')
                        }
                    }

                })
            }
        })

        $(document).on('click', '#update-cart', function() {
            $('#cart_id_item').val($(this).data('cart_id'))
            $('#product_item').val($(this).data('item_name'))
            $('#stock_item').val($(this).data('stock'))
            $('#barcode_item').val($(this).data('barcode'))
            $('#price_item').val($(this).data('price'))
            $('#qty_item').val($(this).data('qty'))
            $('#total_before').val($(this).data('price')) * $(this).data('qty')
            $('#discount_item').val($(this).data('discount'))
            $('#total_item').val($(this).data('total'))
        })

        function count_edit_modal() {
            var price = $('#price_item').val()
            var qty = $('#qty_item').val()
            var discount = $('#discount_item').val()

            total_before = price * qty
            $('#total_before').val(total_before)

            total = (price - discount) * qty
            $('#total_item').val(total)

            if (discount == '') {
                $('#discount_item').val(0)
            }

        }

        $(document).on('keyup mouseup', '#price_item, #qty_item, #discount_item', function() {
            count_edit_modal()
        })

        $(document).on('click', '#edit_cart', function() {
            var cart_id = $('#cart_id_item').val()
            var price = $('#price_item').val()
            var qty = $('#qty_item').val()
            var discount = $('#discount_item').val()
            var total = $('#total_item').val()
            var stock_item = $('#stock_item').val()

            if (price == '' || price < 1) {
                alert('Harga tidak boleh kosong !')
                $('#price_item').focus()
            } else if (qty == '' || qty < 1) {
                alert('Jumlah minimal 1')
                $('#qty_item').focus()
            } else if (parseInt(qty) > parseInt(stock_item)) {
                alert('Stock tidak mencukupi')
                $('#qty_item').focus()
            } else {
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('transaction/process') ?>',
                    data: {
                        'edit_cart': true,
                        'cart_id': cart_id,
                        'price': price,
                        'qty': qty,
                        'discount': discount,
                        'total': total
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.success == true) {
                            $('#cart_table').load('<?= site_url('transaction/cart_data') ?>', function() {
                                calculate()
                            })
                            alert('Data item cart terupdate')
                            $('#modal-item-edit').modal('hide')
                        } else {
                            alert('Data item cart tidak terupdate')
                            $('#modal-item-edit').modal('hide')
                        }
                    }
                })
            }
        })

        function calculate() {
            var subtotal = 0
            $('#cart_table tr').each(function() {
                subtotal += parseInt($(this).find('#total').text())
            })
            isNaN(subtotal) ? $('#subtotal').val(0) : $('#subtotal').val(subtotal)

            var discount = $('#discount_2').val()
            var grand_total = subtotal - discount
            if (isNaN(grand_total)) {
                $('#grand_total').val(0)
                $('#grand_total_2').text(0)
            } else {
                $('#grand_total').val(grand_total)
                $('#grand_total_2').text(grand_total)
            }

            var cash = $('#cash').val();
            cash != 0 ? $('#change').val(cash - grand_total) : $('#change').val(0)
            if (discount == '') {
                $('#discount_2').val(0)
            }
        }

        $(document).on('keyup mouseup', '#discount_2, #cash', function() {
            calculate()
        })

        $(document).ready(function() {
            calculate()
        })

        $(document).on('click', '#process_payment', function() {
            var customer_id = $('#customer').val()
            var subtotal = $('#subtotal').val()
            var discount = $('#discount_2').val()
            var grand_total = $('#grand_total').val()
            var cash = $('#cash').val()
            var change = $('#change').val()
            var note = $('#note').val()
            var date = $('#date').val()
            if (subtotal < 1) {
                alert('Belum ada product yang dipilih')
                $('#barcode').focus()
            } else if (cash < 1) {
                alert('Jumlah uang cash belum diinput')
                $('#cash').focus()
            } else {
                if (confirm('Yakin proses transaksi ini ?')) {
                    $.ajax({
                        type: 'POST',
                        url: '<?= site_url('transaction/process') ?>',
                        data: {
                            'process_payment': true,
                            'customer_id': customer_id,
                            'subtotal': subtotal,
                            'discount': discount,
                            'grand_total': grand_total,
                            'cash': cash,
                            'change': change,
                            'note': note,
                            'date': date
                        },
                        dataType: 'json',
                        success: function(result) {
                            if (result.success) {
                                alert('Transaksi Berhasil');
                                window.open('<?= site_url('transaction/print/') ?>' + result.sales_id, '_blank')
                            } else {
                                alert('Transaksi Gagal');
                            }
                            location.href = '<?= site_url('transaction/sale') ?>'
                        }
                    })
                }
            }
        })

        $(document).on('click', '#cancel_payment', function() {
            if (confirm('Apakah anda yakin ?')) {
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('transaction/cart_delete') ?>',
                    dataType: 'json',
                    data: {
                        'cancel_payment': true
                    },
                    success: function(result) {
                        if (result.success == true) {
                            $('#cart_table').load('<?= site_url('transaction/cart_data') ?>', function() {
                                calculate()
                            })
                        }
                    }
                })
                $('#discount').val(0)
                $('#cash').val(0)
                $('#customer').val('').change()
                $('#barcode').val('')
                $('#barcode').focus()
            }
        })
    </script>