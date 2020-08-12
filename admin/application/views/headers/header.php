<header class="main-header">
    <?php
    //get navigation data
    $navData = nav_data();
    //
    ?>
    <!-- Logo -->
    <a href="<?=base_url()?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>ES</b>P</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>ESP</b>Finder</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav" >
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success"><?=count($navData['messages'])?> </span>
            </a>
            <ul class="dropdown-menu" style="min-width: 330px">
              <li class="header">You have <?=count($navData['messages'])?> messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <?php foreach($navData["messages"] as $message) :?>
                  <li><!-- start message -->
                    <a href="<?=($message['entry_id'] ? base_url().'files/request/'.$message['entry_id'] : '#')?>">
                      <div class="pull-left">
                        <img src="<?=base_url()?>img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        <?=$message['title']?>
                        <small><i class="fa fa-clock-o"></i><?=ago($message['created'])?></small>
                      </h4>
                      <p><?=$message['text']?></p>
                    </a>
                  </li>
                  <?php endforeach;?>
                  <!-- end message -->
                </ul>
              </li>
            </ul>
          </li>

          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"><?=count($navData['notifications'])?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <?=count($navData['notifications'])?> notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <?php foreach($navData["notifications"] as $notification) :?>
                  <li>
                    <a href="#">
                      <b><?=$notification['title']?></b>
                      <div><?=$notification['text']?></div>
                    </a>
                  </li>
                  <?php endforeach;?>
                </ul>
              </li>
            </ul>
          </li>

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?=base_url()?>img/avatar.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?=$_SESSION['user']['firstname']?> <?=$_SESSION['user']['lastname']?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?=base_url()?>img/avatar.png" class="img-circle" alt="User Image">

                <p>
                <?=$_SESSION['user']['firstname']?> <?=$_SESSION['user']['lastname']?> - Administrator
                  <small>Member since <?=$_SESSION['user']['created_at']?></small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?=base_url()?>users/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
