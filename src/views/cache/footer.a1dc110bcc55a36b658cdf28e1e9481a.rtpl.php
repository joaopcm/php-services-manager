<?php if(!class_exists('Rain\Tpl')){exit;}?><footer class="footer">
  <div class="container-fluid">
    <nav class="float-left">
      <ul>
        <li>
          <a href="{function=" getenv('APP_URL')"}">
            <?php echo getenv('APP_SYSTEM_NAME'); ?>
          </a>
        </li>
        <li>
          <small class="text-muted">v<?php echo getenv('APP_VERSION'); ?></small>
        </li>
      </ul>
    </nav>
    <div class="copyright float-right">
      &copy; 2018 - 
      <script>
        document.write(new Date().getFullYear())
      </script>, todos os direitos autorais reservados para
      <a href="<?php echo getenv('APP_URL'); ?>" target="_blank"><?php echo getenv('APP_NAME'); ?></a>.
    </div>
  </div>
</footer>
</div>
</div>
<!--   Core JS Files   -->
<script src="\assets/js/admin/core/jquery.min.js" type="text/javascript"></script>
<script src="\assets/js/admin/core/popper.min.js" type="text/javascript"></script>
<script src="\assets/js/admin/core/bootstrap-material-design.min.js" type="text/javascript"></script>
<script src="\assets/js/admin/plugins/perfect-scrollbar.jquery.min.js"></script>
<!-- Masked Input JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.min.js"></script>
<!-- Chartist JS -->
<script src="\assets/js/admin/plugins/chartist.min.js"></script>
<!-- Chartist Pointlabels Plugin JS -->
<script src="\assets/js/admin/plugins/chartist-plugin-pointlabels.min.js"></script>
<!-- Select 2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<!-- Quill -->
<!-- <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script> -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="\assets/js/admin/quill-config.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="\assets/js/admin/material-dashboard.min.js?v=2.1.0" type="text/javascript"></script>
<!-- Functions JS -->
<script src="\assets/js/admin/main.js"></script>
<script>
  $(document).ready(function () {
    md.initDashboardPageCharts();
  });
</script>
</body>

</html>