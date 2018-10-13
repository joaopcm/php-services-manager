<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Editar Recebimento</h4>
            <p class="card-category">Edite um recebimento para a CVA Climatização</p>
          </div>
          <div class="card-body">
            <form action="/editar/recebimento/<?php echo htmlspecialchars( $recebimento["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="POST">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Cliente</label>
                    <select type="text" class="form-control" name="cliente" id="cliente">
                      <?php $counter1=-1;  if( isset($clientes) && ( is_array($clientes) || $clientes instanceof Traversable ) && sizeof($clientes) ) foreach( $clientes as $key1 => $value1 ){ $counter1++; ?>
                      <option value="<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" <?php if( $recebimento["idcliente"] === $value1["id"] ){ ?>selected<?php } ?>><?php echo htmlspecialchars( $value1["nomeCliente"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Protocolo</label>
                    <select type="text" class="form-control" name="protocolo" id="protocolo">
                      <option value="<?php echo htmlspecialchars( $recebimento["idprotocolo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" selected><?php echo htmlspecialchars( $recebimento["codigo"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $recebimento["servico"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label>Data de Recebimento</label>
                    <input type="date" class="form-control" name="dataRecebimento" value="<?php echo htmlspecialchars( $recebimento["dataRecebimento"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="bmd-label-floating">Valor do Boleto (R$)</label>
                    <input type="text" class="form-control" name="valorBoleto" value="<?php echo htmlspecialchars( $recebimento["valorBoleto"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" data-mask="000.000.000,00" data-mask-reverse="true" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Data de Vencimento</label>
                    <input type="date" class="form-control" name="dataVencimento" value="<?php echo htmlspecialchars( $recebimento["dataVencimento"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Data de Compensação</label>
                    <input type="date" class="form-control" name="dataCompensacao" value="<?php echo htmlspecialchars( $recebimento["dataCompensacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Número do Boleto</label>
                    <input type="text" class="form-control" name="nBoleto" value="<?php echo htmlspecialchars( $recebimento["nBoleto"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" maxlength="15">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                      <label>Forma de Pagamento</label>
                      <select type="text" class="form-control" name="formaPagamento">
                        <option value="Boleto" <?php if( $recebimento["formaPagamento"] === 'Boleto' ){ ?>selected<?php } ?>>Boleto</option>
                        <option value="Depósito" <?php if( $recebimento["formaPagamento"] === 'Depósito' ){ ?>selected<?php } ?>>Depósito</option>
                        <option value="Cheque" <?php if( $recebimento["formaPagamento"] === 'Cheque' ){ ?>selected<?php } ?>>Cheque</option>
                        <option value="Dinheiro" <?php if( $recebimento["formaPagamento"] === 'Dinheiro' ){ ?>selected<?php } ?>>Dinheiro</option>
                        <option value="Transferência Bancária" <?php if( $recebimento["formaPagamento"] === 'Transferência Bancária' ){ ?>selected<?php } ?>>Transferência Bancária</option>
                      </select>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Parcelas</label>
                    <input type="text" class="form-control" name="parcelas" value="<?php echo htmlspecialchars( $recebimento["parcelas"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" max="56" value="1/1" data-mask="0/0" maxlength="3" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Referência</label>
                    <input type="text" class="form-control" name="referencia" value="<?php echo htmlspecialchars( $recebimento["referencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" maxlength="112">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Forma de Envio</label>
                    <select type="text" class="form-control" name="formaEnvio">
                      <option value="E-mail" <?php if( $recebimento["formaEnvio"] === 'E-mail' ){ ?>selected<?php } ?>>E-mail</option>
                      <option value="Whatsapp" <?php if( $recebimento["formaEnvio"] === 'Whatsapp' ){ ?>selected<?php } ?>>Whatsapp</option>
                      <option value="Recebido no local" <?php if( $recebimento["formaEnvio"] === 'Recebido no local' ){ ?>selected<?php } ?>>Recebido no local</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Enviado Por</label>
                    <select type="text" class="form-control" name="enviadoPor">
                      <?php $counter1=-1;  if( isset($usuarios) && ( is_array($usuarios) || $usuarios instanceof Traversable ) && sizeof($usuarios) ) foreach( $usuarios as $key1 => $value1 ){ $counter1++; ?>
                      <option value="<?php echo htmlspecialchars( $value1["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" <?php if( $recebimento["enviadoPor"] === $value1["nome"] ){ ?>selected<?php } ?>><?php echo htmlspecialchars( $value1["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary pull-right">Salvar</button>
              <div class="clearfix"></div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>