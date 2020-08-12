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
               <div class="container-fluid">
                  <div class="row">
                     <div class="box">
                        <div class="box-header with-border">
                           <h3 class="box-title">Manage Files Requests</h3>
                           <div style="margin-top:10px" >
                           <div class="col-md-9">
                              <form method="GET" class="">
                                 <div class="input-group input-group-sm col-md-12">
                                    <div class="col-md-4">
                                    <input value="<?=(isset($_GET['mark']) ? $_GET['mark'] : null)?>" name="mark" class="form-control" type="text" placeholder="Mark , example : BMW">
                                    </div>
                                    <div class="col-md-4">
                                    <input value="<?=(isset($_GET['model']) ? $_GET['model'] : null)?>" name="model" class="form-control" type="text" placeholder="Model , example : SERIES 3 M">
                                    </div>
                                    <div class="col-md-4">
                                    <input value="<?=(isset($_GET['vin']) ? $_GET['vin'] : null)?>" name="vin" class="form-control" type="text" placeholder="VIN , example : VINXXXXXXXXXXXX">
                                    </div>
                                    <span class="input-group-btn">
                                       <button type="submit" class="btn btn-info btn-flat">Search</button>
                                    </span>
                              </div>
                              </form>
                              </div>
                           </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                           <table class="table table-bordered">
                              <tr>
                                 <th style="width: 10px">#</th>
                                 <th>User</th>
                                 <th>Mark</th>
                                 <th>Model</th>
                                 <th>Engine</th>
                                 <th>Vehicule Engine</th>
                                 <th>Year</th>
                                 <th>Created</th>
                                 <th>Status</th>
                                 <th scope="col">Options</th>
                              </tr>
                              <?php foreach($requests as $request) : ?>
                              <tr class="<?=$request["bg"]?>">
                                 <td><?=$request['id']?></td>
                                 <td><?=$request['email']?></td>
                                 <td><?=$request['mark']?></td>
                                 <td><?=$request['model']?></td>
                                 <td><?=strtoupper($request['engine']." ".$request['horsepower'])?></td>
                                 <td><?=strtoupper($request['vengine'])?></td>
                                 <td><?=$request['year']?></td>
                                 <td><?=$request['created']?></td>
                                 <td><?=$request['status']?></td>
                                 <td style="width:30px">
                                    <?php
                                    if($request['status'] != "canceled") {
                                        ?>
                                        <a  class="btn btn-default" href="<?=base_url()?>files/request/<?=$request['id']?>"><i class="fa fa-upload"></i> Process</a>
                                        <?php
                                    }
                                    ?>
                                 </td>
                              </tr>
                              <?php endforeach?>
                           </table>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                           <nav>
                              <ul class="pagination pagination-sm no-margin pull-right">
                                 <li class="page-item <?=(!$pages['prev'] ? "disabled" : null)?>">
                                    <a class="page-link" href="<?=(!$pages['prev'] ? "#" : $pages['current'] - 1)?>?<?=http_build_query($_GET)?>">Previous</a>
                                 </li>
                                 <?php
                                    for($i = 1 ; $i <= $pages['pages'];$i++) {
                                        if(in_array($i,$pages['separations'])) {
                                            ?>
                                 <li class="page-item disabled">
                                    <a class="page-link" href="#">...</a>
                                 </li>
                                 <?php
                                    }
                                    if(!in_array($i,$pages['vector'])) {
                                        continue;
                                    }
                                    ?>
                                 <li class="page-item <?=($i == $pages['current'] ? "active" : "")?>">
                                    <a class="page-link" href="<?=$base_link.$i?>?<?=http_build_query($_GET)?>"><?=$i?></a>
                                 </li>
                                 <?php
                                    }
                                    ?>
                                 <li class="page-item <?=(!$pages['next'] ? "disabled" : null)?>">
                                    <a class="page-link" href="<?=(!$pages['next'] ? "#" : $pages['current'] + 1)?>?<?=http_build_query($_GET)?>">Next</a>
                                 </li>
                              </ul>
                           </nav>
                        </div>
                     </div>
                     <!-- /.box -->
                  </div>
               </div>
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