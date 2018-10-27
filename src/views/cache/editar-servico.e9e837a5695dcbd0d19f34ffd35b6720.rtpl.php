<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Editar Serviço</h4>
            <p class="card-category">Edite um serviço para <?php echo getenv('APP_NAME'); ?></p>
          </div>
          <div class="card-body">
            <form action="/admin/editar/servico/<?php echo htmlspecialchars( $servico["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="POST">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Título do Serviço</label>
                    <input type="text" class="form-control" name="titulo" value="<?php echo htmlspecialchars( $servico["titulo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" maxlength="56" required>
                  </div>
                </div>
              </div>
              <input type="hidden" name="_METHOD" value="PUT"/>
              <button type="submit" class="btn btn-primary pull-right">Salvar</button>
              <div class="clearfix"></div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>