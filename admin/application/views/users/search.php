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
                           <h3 class="box-title">Manage Users</h3>
                           <div class="col-md-12">
                              <form style="margin-top:25px" method="GET" class="">
                                 <div class="input-group input-group-sm col-md-12">
                                    <div class="col-md-4">
                                       <input value="<?=(isset($_GET['email']) ? $_GET['email'] : null)?>" name="email" class="form-control" type="text" placeholder="E-mail">
                                    </div>
                                    <div class="col-md-4">
                                       <input value="<?=(isset($_GET['firstname']) ? $_GET['firstname'] : null)?>" name="firstname" class="form-control" type="text" placeholder="Firstname">
                                    </div>
                                    <div class="col-md-4">
                                       <input value="<?=(isset($_GET['lastname']) ? $_GET['lastname'] : null)?>" name="lastname" class="form-control" type="text" placeholder="Lastname">
                                    </div>
                                    <span class="input-group-btn">
                                    <button type="submit" class="btn btn-info btn-flat">Search</button>
                                    </span>
                                 </div>
                              </form>
                           </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                           <table class="table table-bordered">
                              <tr>
                                 <th style="width: 10px">#</th>
                                 <!-- <th>Type</th> -->
                                 <th>Full name</th>
                                 <th scope="col">Email</th>
                                 <th scope="col">Created</th>
                                 <th scope="col">Updated</th>
                                 <th scope="col">Options</th>
                              </tr>
                              <?php foreach($users as $user) : ?>
                              <tr>
                                 <td><?=$user['id']?></td>
                                 <!-- <td></td> -->
                                 <td><?=$user['firstname'].' '.$user['lastname']?></td>
                                 <td><?=$user['email']?></td>
                                 <td><?=$user['created_at']?></td>
                                 <td><?=$user['updated_at']?></td>
                                 <td>
                                    <a class="btn" onclick='confirm_remove()' href="<?=base_url()?>users/remove/<?=$user['id']?>" id="remove"><i class="fa fa-remove"></i></a>
                                    <a class="btn" href="<?=base_url()?>users/edit/<?=$user['id']?>" id="edit"><i class="fa fa-edit"></i></a>
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
