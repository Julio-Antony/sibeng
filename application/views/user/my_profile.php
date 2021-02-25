<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Profile</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-success card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="<?= base_url('/assets/dist/img/') . $user->image ?>" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center"><?= $user->username ?></h3>

                        <p class="text-muted text-center"><?= $user->level == '1' ? 'Admin' : 'Kasir' ?></p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong> <a class="float-right"><?= $user->address ?></a>
                            </li>
                            <li class="list-group-item">
                                <strong><i class="fas fa-at"></i></i> Email</strong> <a class="float-right"><?= $user->email ?></a>
                            </li>
                            <li class="list-group-item">
                                <strong><i class="fas fa-sign-in-alt"></i> Joined</strong> <a class="float-right"><?= $user->joined ?></a>
                            </li>
                        </ul>
                        <a href="<?= site_url('user/edit/') . $user->user_id ?>" class="btn btn-success btn-center btn-block">Edit</a>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.card -->

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->