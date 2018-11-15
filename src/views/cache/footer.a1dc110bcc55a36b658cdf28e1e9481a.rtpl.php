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
<script src="\assets/js/admin/core/jquery.min.js" type="text/javascript"></script>
<script src="\assets/js/admin/core/popper.min.js" type="text/javascript"></script>
<script src="\assets/js/admin/core/bootstrap-material-design.min.js" type="text/javascript"></script>
<script src="\assets/js/admin/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="\assets/js/admin/plugins/jquery.mask.min.js" type="text/javascript"></script>
<script src="\assets/js/admin/plugins/chartist.min.js" type="text/javascript"></script>
<script src="\assets/js/admin/plugins/chartist-plugin-pointlabels.min.js" type="text/javascript"></script>
<script src="\assets/js/admin/plugins/select2.min.js" type="text/javascript"></script>
<script src="\assets/js/admin/plugins/quill.min.js" type="text/javascript"></script>
<script src="\assets/js/admin/quill-config.js" type="text/javascript"></script>
<script src="\assets/js/admin/material-dashboard.min.js?v=2.1.0" type="text/javascript"></script>
<script src="\assets/js/admin/main.js" type="text/javascript"></script>
<script>
  $(document).ready(function () {
    md.initDashboardPageCharts();
  });
</script>
</body>

</html>