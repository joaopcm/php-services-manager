<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Adicionar Serviço</h4>
            <p class="card-category">Cadastre um serviço para <?php echo getenv('APP_NAME'); ?></p>
          </div>
          <div class="card-body">
            <form action="/admin/adicionar/servico" method="POST">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Título do Serviço</label>
                    <input type="text" class="form-control" name="titulo" maxlength="56" required>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary pull-right">Adicionar</button>
              <div class="clearfix"></div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>