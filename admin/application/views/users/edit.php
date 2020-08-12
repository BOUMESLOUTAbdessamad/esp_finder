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
                           <h1><?=($method == 'create') ? 'Create a new user':'Update user'?></h1>
                        </div>
                        <form action="" class="" method="post" role="form">
                           <div class="box-body">
                              <div class="">
                                 <?php if(isset($errors)) :?>
                                 <?php foreach($errors as $error) :?>
                                 <div class="alert alert-danger"><?=$error?></div>
                                 <?php endforeach?>
                                 <?php endif?>
                              </div>
                              <div class="form-group col-md-4">
                                 <label>Username</label>
                                 <input value="<?=(isset($_POST['user']['username']) ? $_POST["user"]['username'] : null)?>" name="user[username]" class="form-control" />
                              </div>
                              <div class="form-group col-md-4">
                                 <label>Password</label>
                                 <input type="password" value="<?=(isset($_POST['user']['password']) ? $_POST['user']['password'] : null)?>" name="user[password]" class="form-control" />
                              </div>
                              <div class="form-group col-md-4">
                                 <label>Email</label>
                                 <input value="<?=(isset($_POST['user']['email']) ? $_POST["user"]['email'] : null)?>" name="user[email]" class="form-control" />
                              </div>
                              <div class="form-group col-md-4">
                                 <label>Phone</label>
                                 <input value="<?=(isset($_POST['user']['phone']) ? $_POST["user"]['phone'] : null)?>" name="user[phone]" class="form-control col-6" />
                              </div>

                              <div class="form-group col-md-6">
                                 <label>First name</label>
                                 <input value="<?=(isset($_POST['user']['firstname']) ? $_POST["user"]['firstname'] : null)?>" name="user[firstname]" class="form-control" />
                              </div>
                              <div class="form-group col-md-6">
                                 <label>Last name</label>
                                 <input value="<?=(isset($_POST['user']['lastname']) ? $_POST["user"]['lastname'] : null)?>" name="user[lastname]" class="form-control" />
                              </div>

                              <div class="form-group col-md-4">
                                 <label>Role</label>
                                 <select class="form-control" name="user[role]" id="role">
                                       <option value="user">User</option>
                                       <option value="admin">Admin</option>
                                 </select>
                              </div>
                           </div>
                           <div class="box-footer">
                              <button type="submit" name="action" value="<?=(isset($_POST['user']) && isset($_POST['user']['id']) ? "update" : "create")?>" class="btn btn-primary"><?=(isset($_POST['user']) && isset($_POST['user']['id']) ? "Update" : "Create")?></button>
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
   </body>
</html>
