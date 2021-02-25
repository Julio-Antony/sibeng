<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print <?= $row->item_name ?></title>
</head>

<body>
    <img src="<?= base_url('assets/dist/img/barcode/item-' . $row->item_id . '.png') ?>" width="200">
    <br>
    <?= $row->barcode ?>
</body>

</html>