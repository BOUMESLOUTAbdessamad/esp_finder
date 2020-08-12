<!-- jQuery 3 -->
<script src="<?=base_url()?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url()?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url()?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="<?=base_url()?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="<?=base_url()?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?=base_url()?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="<?=base_url()?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="<?=base_url()?>bower_components/chart.js/Chart.js"></script>
<!-- bootstrap datepicker -->
<script src="<?=base_url()?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?=base_url()?>js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url()?>js/demo.js"></script>
<script src="<?=base_url()?>js/vue.js"></script>
<script src="<?=base_url()?>js/Models/Files.js"></script>
<script src="<?=base_url()?>js/toastr.js"></script>

<!-- Summernote -->
<script src="<?=base_url()?>js/summernote.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.js"></script> -->

<script src="<?=base_url()?>js/bootstrap-tagsinput.min.js"></script>

<script>
    BASE_URL = "<?=base_url()?>";
    SITE_URL = "<?=str_replace("admin.","",base_url())?>";
    USER = <?=(isset($_SESSION['user']) ? $_SESSION['user']['id'] : null)?>;
</script>
