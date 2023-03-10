<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit User</h1>
            </div><!-- /.col -->
            <div class="offset-sm-5 col-sm-1">
                <a href="<?= site_url('user/list') ?>" class="btn btn-danger">Back</a>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-8">
                <div class="tab-pane" id="settings">
                    <form class="form-horizontal" action="" method="POST">
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="hidden" name="user_id" value="<?= $row->user_id ?>">
                                <input type="text" class="form-control <?= form_error('name') ? 'is-invalid' : null ?>" name="name" value="<?= $this->input->post('name') ?? $row->username ?>" placeholder="Name">
                                <?= form_error('name', '<p class="text-danger">', '</p>') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control <?= form_error('email') ? 'is-invalid' : null ?>" name="email" value="<?= $this->input->post('email') ?? $row->email ?>" placeholder="Email">
                                <?= form_error('email', '<p class="text-danger">', '</p>') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control <?= form_error('password') ? 'is-invalid' : null ?>" name="password" value="<?= $this->input->post('password') ?>" placeholder="Password">
                                <?= form_error('password', '<p class="text-danger">', '</p>') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control <?= form_error('password2') ? 'is-invalid' : null ?>" name="password2" value="<?= $this->input->post('password2') ?>" placeholder="Confirm Password">
                                <?= form_error('password2', '<p class="text-danger">', '</p>') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputAddress" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <textarea class="form-control <?= form_error('address') ? 'is-invalid' : null ?>" name="address" placeholder="Address"><?= $this->input->post('address') ?? $row->address ?></textarea>
                                <?= form_error('address', '<p class="text-danger">', '</p>') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputLevel" class="col-sm-2 col-form-label">Level</label>
                            <div class="col-sm-10">
                                <select name="level" class="form-control <?= form_error('level') ? 'is-invalid' : null ?>">
                                    <?php $level = $this->input->post('level') ? $this->input->post('level') : $row->level ?>
                                    <option value="1" <?= $level == 1 ? 'selected' : null ?>>Admin</option>
                                    <option value="2" <?= $level == 2 ? 'selected' : null ?>>Kasir</option>
                                </select>
                                <?= form_error('level', '<p class="text-danger">', '</p>') ?>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-danger">Submit</button>
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