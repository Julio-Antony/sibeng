<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-boxes nav-icon"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Item</span>
                        <span class="info-box-number">
                            <?= $this->fungsi->count_item() ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-friends nav-icon"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Customer</span>
                        <span class="info-box-number"><?= $this->fungsi->count_customer() ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-truck nav-icon"></i></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Supplier</span>
                        <span class="info-box-number"><?= $this->fungsi->count_supplier() ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Users</span>
                        <span class="info-box-number"><?= $this->fungsi->count_user() ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!--/. container-fluid -->

    <!-- BAR CHART -->
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Top Product chart</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div id="myfirstchart" style="height: 250px;"></div>
                </div>
                <div class="col-md-4">
                    <div class="card-body p-1 ">
                        <?php foreach ($row as $data) : ?>
                            <ul class="products-list product-list-in-card pl-2 pr-2">
                                <li class="item">
                                    <div class="product-img">
                                        <img src="<?= base_url('assets/dist/img/product/' . $data->image) ?>" alt="Product Image" class="img-size-50">
                                    </div>
                                    <div class="product-info">
                                        <a href="javascript:void(0)" class="product-title text-dark"><?= $data->item_name ?>
                                            <span class="product-description">
                                                <?= $data->sold ?> Porsi
                                            </span>
                                    </div>
                                </li>
                            </ul>
                        <?php endforeach; ?>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-center">
                        <a href="<?= site_url('report/sales_report') ?>" class="uppercase text-dark">View All Products</a>
                    </div>
                    <!-- /.card-footer -->
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<script>
    new Morris.Bar({
        // ID of the element in which to draw the chart.
        element: 'myfirstchart',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: [
            <?php foreach ($row as $data) {
                echo "{ item :'" . $data->item_name . "', sold :'" . $data->sold . "'},";
            } ?>
        ],
        // The name of the data record attribute that contains x-values.
        xkey: 'item',
        // A list of names of data record attributes that contain y-values.
        ykeys: ['sold'],
        // Labels for the ykeys -- will be displayed when you hover over the
        // chart.
        labels: ['sold']
    });
</script>