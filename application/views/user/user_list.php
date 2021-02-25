<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">User List</h1>
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
                        <h3 class="card-title">Fixed Header Table</h3>
                        <?php if ($this->fungsi->user_login()->level == 1) { ?>
                            <div class="float-right">
                                <a href="<?= site_url('user/add') ?>" class="btn btn-primary btn-flat btn-sm">
                                    <i class="fa fa-user-plus"></i>
                                    Add User
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-1">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Level</th>
                                    <?php if ($this->fungsi->user_login()->level == 1) { ?>
                                        <th>Action</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($row->result() as $key => $data) { ?>
                                    <tr>
                                        <td><?= $no++ ?>.</td>
                                        <td><?= $data->email ?></td>
                                        <td><?= $data->username ?></td>
                                        <td><?= $data->address ?></td>
                                        <td><?= $data->level == 1 ? "Admin" : "Kasir" ?></td>
                                        <?php if ($this->fungsi->user_login()->level == 1) { ?>
                                            <td>
                                                <form action="<?= site_url('user/delete') ?>" method="post">
                                                    <a href="<?= site_url('user/edit/' . $data->user_id) ?>" class="btn btn-success btn-flat btn-xs">
                                                        <i class="fas fa-pencil-alt"></i>
                                                        Edit
                                                    </a>
                                                    <input type="hidden" name="user_id" value="<?= $data->user_id ?>">
                                                    <button class="btn btn-danger btn-flat btn-xs" onclick="return confirm('Apakah anda yakin?')">
                                                        <i class="fa fa-trash"></i>
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        <?php } ?>
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