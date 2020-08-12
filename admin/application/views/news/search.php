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
                           <h3 class="box-title">Manage News</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                           <table class="table table-bordered">
                              <tr>
                                 <th scope="col">#ID</th>
                                 <th scope="col">Title</th>
                                 <th scope="col">Content</th>
                                 <th scope="col">Cover</th>
                                 <th scope="col">Created</th>
                                 <th scope="col">Updated</th>
                                 <th scope="col">Options</th>
                              </tr>
                              <?php foreach($posts as $post) : ?>
                              <tr>
                                 <td><?=$post['id']?></td>
                                 <td><?=$post['title']?></td>
                                 <td><?=$post['content']?></td>
                                 <td><img style="width : 64px" src="<?=str_replace("admin.","",base_url())?>uploads/<?=$post['image_path']?><?=$post['image_name']?>" alt=""></td>
                                 <td><?=$post['created']?></td>
                                 <td><?=$post['updated']?></td>
                                 <td>
                                    <a class="btn" onclick='confirm_remove()' href="<?=base_url()?>posts/remove/<?=$post['id']?>" id="remove"><i class="fa fa-remove"></i></a>
                                    <a class="btn" href="<?=base_url()?>posts/edit/<?=$post['id']?>" id="edit"><i class="fa fa-edit"></i></a>
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