<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Barcode Generator</h1>
            </div><!-- /.col -->
            <div class="offset-sm-5 col-sm-1">
                <a href="<?= site_url('product/item') ?>" class="btn btn-info">Back</a>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <?php
                $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($row->barcode, $generator::TYPE_CODE_128)) . '" width="200">';
                ?>
                <br>
                <?= $row->barcode ?>
                <br><br>
                <a href="<?= site_url('product/print_barcode/' . $row->item_id) ?>" target="_blank" class="btn btn-default">
                    <i class="fa fa-print"></i>
                    Print</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <?php
                $qrCode = new Endroid\QrCode\QrCode($row->barcode);
                $qrCode->writeFile('assets/dist/img/barcode/item-' . $row->item_id . '.png');
                ?>
                <img src="<?= base_url('assets/dist/img/barcode/item-' . $row->item_id . '.png') ?>" width="200">
                <br>
                <?= $row->barcode ?>
                <br><br>
                <a href="<?= site_url('product/print_qrcode/' . $row->item_id) ?>" target="_blank" class="btn btn-default">
                    <i class="fa fa-print"></i>
                    Print</a>
            </div>
        </div>
    </div>
</section>