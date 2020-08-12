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
               <div class="row">
                  <div class="col-md-12">
                     <div class="box box-primary">
                        <div class="box-header with-border">
                           <h1><?=($method == 'create') ? 'Create a new Post':'Update Post'?></h1>
                        </div>
                        <form action="" class="" method="post" role="form">
                           <div class="box-body">
                              <div class="">
                                 <?php foreach($errors as $error) :?>
                                 <div class="alert alert-danger"><?=$error?></div>
                                 <?php endforeach?>
                              </div>
                              <div class="form-group col-md-12">
                                 <label for="title">News Title</label>
                                 <input class="form-control" type="text" value="<?=(isset($_POST['post']['title'])) ? $_POST['post']['title'] : ''?>" name="post[title]" id="title" placeholder="OEM BMW Wheels...">
                              </div>
                              <div class="form-group col-md-12">
                                 <label for="content">News content</label>
                                 <textarea class="form-control" name="post[content]"><?=(isset($_POST['post']['content'])) ? $_POST['post']['content'] : ''?></textarea>
                              </div>
                              <div class="col-md-12 form-group">
                                    <label id="fileName" for="">(No File Selected)</label><br>
                                    <input name="post[image]" value="<?=(isset($_POST['post']['image'])) ? $_POST['post']['image'] : ''?>" type="text" class="hidden" id="fileIdHolder">
                                    <input type="file" style="display : none" id="fileInput">
                                    <button type="button" class="btn btn-default" id="fileBrowse" >Browse</button>
                              </div>
                           </div>
                           <div class="box-footer">
                           <div class="form-group col-md-12">
                              <button type="submit" name="action" value="<?=(isset($_POST['post']) && isset($_POST['post']['id']) ? "update" : "create")?>" class="btn btn-primary"><?=(isset($_POST['post']) && isset($_POST['post']['id']) ? "Save changes" : "Create")?></button>
                           </div>
                           </div>
                        </form>
                     </div>
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
      <script src="<?=base_url()?>js/Models/Files.js"></script>
      <script src="<?=base_url()?>js/jquery.form.js"></script>
      <script>
            $(document).ready(function() {
                Files.Upload.bind($('#fileBrowse'),$('#fileInput'),$('#fileIdHolder'),function(r) {
                    $('#fileName').html(r.file_name);
                });
            });
        </script>
   </body>
</html>