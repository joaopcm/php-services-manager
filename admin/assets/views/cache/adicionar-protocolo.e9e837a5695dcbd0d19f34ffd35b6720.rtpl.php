<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Adicionar Protocolo</h4>
            <p class="card-category">Cadastre um protocolo para a CVA Climatização</p>
          </div>
          <div class="card-body">
            <form action="/adicionar/protocolo" method="POST">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Cliente</label>
                    <select type="text" class="form-control" name="cliente">
                      <?php $counter1=-1;  if( isset($clientes) && ( is_array($clientes) || $clientes instanceof Traversable ) && sizeof($clientes) ) foreach( $clientes as $key1 => $value1 ){ $counter1++; ?>
                      <option value="<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nomeCliente"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Serviço</label>
                    <select type="text" class="form-control" name="servico">
                      <?php $counter1=-1;  if( isset($servicos) && ( is_array($servicos) || $servicos instanceof Traversable ) && sizeof($servicos) ) foreach( $servicos as $key1 => $value1 ){ $counter1++; ?>
                      <option value="<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["titulo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <!-- <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label role="button" class="btn btn-primary" for="opload-os">Enviar OS</label>
                    <input type="file" class="form-control-file" id="opload-os" name="upload-os">
                  </div>
                </div>
              </div> -->
              <button type="submit" class="btn btn-primary pull-right">Adicionar</button>
              <div class="clearfix"></div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>