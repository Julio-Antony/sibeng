<?php $no = 1;
if ($cart->num_rows() > 0) {
    foreach ($cart->result() as $data) { ?>
        <tr>
            <td><?= $no++ ?></td>
            <td class="barcode"><?= $data->part_number ? $data->part_number : "-"  ?></td>
            <td><?= $data->cart_name ?></td>
            <td class="text-right"><?= $data->cart_price ?></td>
            <td class="text-center"><?= $data->qty ?></td>
            <td class="text-right" id="total"><?= $data->total ?></td>
            <td class="text-center" width="160">
                <button id="update-cart" data-toggle="modal" data-target="#modal-item-edit" data-cart_id="<?= $data->cart_id ?>" data-part_number="<?= $data->part_number ?>" data-product_name="<?= $data->product_name ?>" data-price="<?= $data->price ?>" data-qty="<?= $data->qty ?>" data-stock="<?= $data->stock ?>" data-total="<?= $data->total ?>" class="btn btn-xs btn-primary">
                    <i class="fas fa-pencil-alt"></i> Update
                </button>
                <button id="delete_cart" data-cart_id="<?= $data->cart_id ?>" class="btn btn-xs btn-danger">
                    <i class="fa fa-trash"></i> Delete
                </button>
            </td>
        </tr>
<?php
    }
} else {
    echo '<tr>
            <td colspan="8" class="text-center">Tidak ada item</td>
        </tr>';
} ?>