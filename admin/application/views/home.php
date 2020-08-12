<!DOCTYPE html>
<html>
    <?=view_loader("headers/head.php",[],true)?>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?=view_loader("headers/header.php",[],true)?>
            <?=view_loader("headers/nav.php",[],true)?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <!-- Info boxes -->
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Users</span>
                                    <span class="info-box-number"><?=$usersCount?></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-red"><i class="fa fa-file-archive-o"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Requests</span>
                                    <span class="info-box-number">33</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <!-- fix for small devices only -->
                        <div class="clearfix visible-sm-block"></div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="fa fa-credit-card"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Today Sales</span>
                                    <span class="info-box-number">33</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-yellow"><i class="fa fa-user-plus"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">New Users</span>
                                    <span class="info-box-number"><?=$newUsers?></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <!-- Main row -->
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-md-12">
                            <!-- USERS LIST -->
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Recent Registred Users</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table class="table no-margin">
                                            <thead>
                                                <tr>
                                                    <th>USER ID</th>
                                                    <th>Full Name</th>
                                                    <th>E-mail</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($lastUsers as $user) : ?>
                                                <tr>
                                                    <td><?=$user['id']?></td>
                                                    <td><?=$user['firstname']?> <?=$user['lastname']?></td>
                                                    <td><?=$user['email']?></td>
                                                </tr>
                                                <?php endforeach?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer clearfix">
                                    <a href="<?=base_url()?>users/search"class="btn btn-sm btn-info btn-flat pull-left">View All Users</a>
                                </div>
                                <!-- /.box-footer -->
                            </div>
                        </div>
                        <!-- /.col -->
                        <!-- /.row -->
                    </div>
                    <!-- /.col -->
                    <!-- /.row -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <?=view_loader("footers/footer.php",[],true)?>
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
                immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->
        <?=view_loader("footers/foot.php",[],true)?>
    </body>
</html>
