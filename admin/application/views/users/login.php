<!DOCTYPE html>
<html>
   <?=view_loader("headers/head.php",[],true)?>
   <body class="hold-transition login-page">
      <div class="login-box">
         <div class="login-logo">
            <a href="<?=base_url()?>"><b>ESP</b>Finder</a>
         </div>
         <?php
            foreach($errors as $error):?>
         <div class="alert alert-danger">
            <strong>Error ! </strong><?=$error?>
         </div>
         <?php endforeach;?>
         <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <form action="" method="post">
               <div class="form-group has-feedback">
                  <input name="email" type="email" class="form-control" placeholder="Email">
                  <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
               </div>
               <div class="form-group has-feedback">
                  <input name="password" type="password" class="form-control" placeholder="Password">
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
               </div>
               <div class="row">
                  <div class="col-xs-8">
                     <div class="checkbox">
                        <label>
                        <input name="remember" type="checkbox"> Remember Me
                        </label>
                     </div>
                  </div>
                  <div class="col-xs-4">
                     <button name="action" value="login" type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
      <?=view_loader("footers/foot.php",[],true)?>
   </body>
</html>
