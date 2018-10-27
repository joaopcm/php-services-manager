<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Editar Usuário</h4>
            <p class="card-category">Edite um usuário para <?php echo getenv('APP_NAME'); ?></p>
          </div>
          <div class="card-body">
            <form action="/admin/editar/usuario/<?php echo htmlspecialchars( $usuario["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="POST">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Nome</label>
                    <input type="text" class="form-control" name="nome" value="<?php echo htmlspecialchars( $usuario["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" maxlength="56" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Usuário</label>
                    <input type="text" class="form-control" name="login" value="<?php echo htmlspecialchars( $usuario["usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" maxlength="56" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Senha</label>
                    <input type="password" class="form-control" name="senha" maxlength="32" required>
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