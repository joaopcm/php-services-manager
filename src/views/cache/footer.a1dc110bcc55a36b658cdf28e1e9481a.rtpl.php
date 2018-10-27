<?php if(!class_exists('Rain\Tpl')){exit;}?><footer class="footer">
  <div class="container-fluid">
    <nav class="float-left">
      <ul>
        <li>
          <a href="{function=" getenv('APP_URL')"}">
            <?php echo getenv('APP_NAME'); ?>
          </a>
        </li>
        <li>
          <small class="text-muted">v<?php echo getenv('APP_VERSION'); ?></small>
        </li>
        <!-- <li>
            <a href="#">
              Sobre Nós
            </a>
          </li>
          <li>
            <a href="#">
              Blog
            </a>
          </li>
          <li>
            <a href="#">
              Licenças
            </a>
          </li> -->
      </ul>
    </nav>
    <div class="copyright float-right">
      &copy; 2018 - 
      <script>
        document.write(new Date().getFullYear())
      </script>, todos os direitos autorais reservados para
      <a href="{function=" getenv('APP_URL')"}" target="_blank"><?php echo getenv('APP_NAME'); ?></a>.
    </div>
  </div>
</footer>
</div>
</div>
<!--   Core JS Files   -->
<script src="\assets/js/core/jquery.min.js" type="text/javascript"></script>
<script src="\assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="\assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
<script src="\assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!-- Masked Input JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.min.js"></script>
<!-- Chartist JS -->
<script src="\assets/js/plugins/chartist.min.js"></script>
<!-- Chartist Pointlabels Plugin JS -->
<script src="\assets/js/plugins/chartist-plugin-pointlabels.min.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="\assets/js/material-dashboard.min.js?v=2.1.0" type="text/javascript"></script>
<!-- Functions JS -->
<script src="\assets/js/main.js"></script>
<script>
  $(document).ready(function () {
    md.initDashboardPageCharts();
  });
</script>
</body>

</html>