<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" id="nav">
        <!-- Sidebar user panel -->
      <div  class="user-panel">
            <div class="pull-left image">
                <img src="<?=base_url()?>img/avatar.png" class="img-circle" alt="User Image">
            </div>
        <div  class="pull-left info">
          <p ><?=$_SESSION['user']['firstname']?> <?php echo substr($_SESSION['user']['lastname'],0,1).".";?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                <i class="fa fa-search"></i>
                </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview menu <?=active_menu("welcome")?>">
                <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?=active_menu("welcome","home")?>"><a href="<?=base_url()?>"><i class="fa fa-circle-o"></i>Overview</a></li>
                </ul>
            </li>
            <li class="treeview menu <?=active_menu("users")?>">
                <a href="#">
                <i class="fa fa-users"></i> <span>Users</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?=active_menu("users","search")?>"><a href="<?=base_url()?>users/search"><i class="fa fa-circle-o"></i>List</a></li>
                    <li class="<?=active_menu("users","edit")?>"><a href="<?=base_url()?>users/edit"><i class="fa fa-circle-o"></i> Add New</a></li>
                </ul>
            </li>
            <li class="treeview menu <?=active_menu("users")?>">
                <a href="#">
                <i class="fa fa-circle-o"></i> <span>Manage</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?=active_menu("projects","search")?>"><a href="<?=base_url()?>projects/search"><i class="fa fa-file-powerpoint-o" aria-hidden="true"></i> Projects
                    <span v-if=" projectsCount > 0 " class="pull-right badge bg-blue">{{projectsCount}}</span></a></li>
                </a></li>
                </ul>
            </li>

            <li class="treeview menu <?=active_menu("posts")?>">
                <a href="#">
                    <i class="fa fa-clipboard"></i> <span>News</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?=active_menu("posts","search")?>"><a href="<?=base_url()?>posts/search"><i class="fa fa-circle-o"></i>List</a></li>
                    <li class="<?=active_menu("posts","edit")?>"><a href="<?=base_url()?>posts/edit"><i class="fa fa-circle-o"></i>Add New</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
<script src="<?=base_url()?>js/vue.js"></script>
<script src="<?=base_url()?>bower_components/jquery/dist/jquery.min.js"></script>

<script>
    BASE_URL = "<?=base_url()?>";
    SITE_URL = "<?=str_replace(".admin","",base_url())?>";
    USER = <?=(isset($_SESSION['user']) ? $_SESSION['user']['id'] : null)?>;

    var Nav = new Vue({
        el : "#nav",
        data : {
            projectsCount : 0,
        },
        methods : {
            count : function() {

                $.get( BASE_URL + "projects/count_projects", {}, function(r) {
                    Nav.projectsCount = Nav.projectsCount +  r.data.projects_count;
                })
            }
        }
    });
    Nav.count();
</script>
