<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Service</h1>
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
                        <h3 class="card-title">Daftar Service</h3>
                        <div class="float-right">
                            <a href="<?= site_url('service/add') ?>" class="btn btn-danger btn-flat btn-sm">
                                <i class="fa fa-plus"></i>
                                Tambah SerVice
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-1">
                        <table class="table table-bordered text-center" id="table-1">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Dibuat</th>
                                    <th>Diperbarui</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($row->result() as $key => $data) { ?>
                                    <tr>
                                        <td><?= $no++ ?>.</td>
                                        <td><?= $data->service_name ?></td>
                                        <td><?= $data->price ?></td>
                                        <td><?= $data->created ?></td>
                                        <td><?= $data->updated ?></td>
                                        <td>
                                            <a href="<?= site_url('service/edit/' . $data->service_id) ?>" class="btn btn-success btn-flat btn-xs">
                                                <i class="fas fa-pencil-alt"></i>
                                                Sunting
                                            </a>
                                            <a href="<?= site_url('service/delete/' . $data->service_id) ?>" onclick="return confirm('yakin hapus data?')" class="btn btn-danger btn-flat btn-xs">
                                                <i class="fas fa-trash"></i>
                                                Hapus
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