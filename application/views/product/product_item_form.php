<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?= ucfirst($page) ?> item</h1>
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
        <div class="row">
            <div class="col-8">
                <?php $this->view('message') ?>
                <div class="tab-pane" id="settings">
                    <?= form_open_multipart('product/process_item') ?>
                    <div class="form-group row">
                        <label for="image" class="col-sm-2 col-form-label">image</label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-3">
                                    <?php if ($page == 'edit') {
                                        if ($row->image != null) { ?>
                                            <img src="<?= base_url('assets/dist/img/product/' . $row->image) ?>" class="img-thumbnail mb-2">
                                    <?php }
                                    }
                                    ?>
                                </div>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="form-control" id="image" name="image">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="barcode" class="col-sm-2 col-form-label">Barcode</label>
                        <div class="col-sm-10">
                            <input type="hidden" name="id" value="<?= $row->item_id ?>">
                            <input type="text" class="form-control" id="barcode" name="barcode" value="<?= $row->barcode ?>" placeholder="Barcode" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="item_name" class="col-sm-2 col-form-label">item Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="item_name" name="item_name" value="<?= $row->item_name ?>" placeholder="item Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                            <select name="category" class="form-control" required>
                                <option value="">- Pilih -</option>
                                <?php foreach ($category->result() as $key => $data) { ?>
                                    <option value="<?= $data->category_id ?>" <?= $data->category_id == $row->category_id ? "selected" : null ?>><?= $data->category_name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Unit</label>
                        <div class="col-sm-10">
                            <?= form_dropdown(
                                'unit_id',
                                $unit,
                                $selectedunit,
                                ['class' => 'form-control', 'required' => 'required']
                            ) ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="price" name="price" value="<?= $row->price ?>" placeholder="Price" required>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" name="<?= $page ?>" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-warning">reset</button>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
                <!-- /.tab-pane -->
            </div>
        </div>
    </div>
</section>