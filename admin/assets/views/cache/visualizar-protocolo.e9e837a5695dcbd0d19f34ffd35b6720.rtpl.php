<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="modal fade bd-example-modal-lg" id="img-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <a id="img-link" href="">
          <img id="img-md" class="center" src="" alt="">
        </a>
      </div>
      <div class="modal-footer">
        <button id="redirect-btn" type="button" class="btn btn-primary">
          <i class="material-icons">fullscreen</i>
          Visualizar em tela cheia
        </button>
        <button id="download-img" type="button" class="btn btn-primary">
          <i class="material-icons">cloud_download</i>
          Baixar
        </button>
      </div>
    </div>
  </div>
</div>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">Visão geral do protoloco <?php echo htmlspecialchars( $protocolo["codigo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h4>
                <p class="card-category"><?php echo htmlspecialchars( $cliente["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Cliente</label>
                      <input type="text" class="form-control" value="<?php echo htmlspecialchars( $protocolo["cliente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Serviço</label>
                      <input type="text" class="form-control" value="<?php if( $protocolo["servico"] != '' ){ ?><?php echo htmlspecialchars( $protocolo["servico"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php }else{ ?>Serviço deletado<?php } ?>" disabled>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Código</label>
                      <input type="text" class="form-control" value="<?php echo htmlspecialchars( $protocolo["codigo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Criado Em</label>
                      <input type="text" class="form-control" value="<?php echo date('d/m/Y', strtotime($protocolo["dataCadastro"])); ?>" disabled>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">Pagamento referente ao procotolo</h4>
              </div>
              <div class="card-body">
                <?php if( $recebimento ){ ?>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Data de Recebimento</label>
                      <input type="text" class="form-control" value="<?php echo date('d/m/Y', strtotime($recebimento["dataRecebimento"])); ?>" disabled>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Cliente</label>
                      <input type="text" class="form-control" value="<?php echo htmlspecialchars( $recebimento["cliente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Valor do Boleto</label>
                      <input type="text" class="form-control" value="R$ <?php echo number_format($recebimento["valorBoleto"], 2, ',' , '.' ); ?>" disabled>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Data de Vencimento</label>
                      <input type="text" class="form-control" value="<?php echo date('d/m/Y', strtotime($recebimento["dataVencimento"])); ?>" disabled>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Data de Compensação</label>
                      <input type="text" class="form-control" <?php if( $recebimento["dataCompensacao"] != '' ){ ?> value="<?php echo date('d/m/Y', strtotime($recebimento["dataCompensacao"])); ?>" <?php } ?> disabled>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Nº do Boleto</label>
                      <input type="text" class="form-control" value="<?php echo htmlspecialchars( $recebimento["nBoleto"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">Forma de Pagamento</label>
                      <input type="text" class="form-control" value="<?php echo htmlspecialchars( $recebimento["formaPagamento"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <label class="bmd-label-floating">Parcelas</label>
                      <input type="text" class="form-control" value="<?php echo htmlspecialchars( $recebimento["parcelas"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Referência</label>
                      <input type="text" class="form-control" value="<?php echo htmlspecialchars( $recebimento["referencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Forma de Envio</label>
                      <input type="text" class="form-control" value="<?php echo htmlspecialchars( $recebimento["formaEnvio"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">Enviado Por</label>
                      <input type="text" class="form-control" value="<?php echo htmlspecialchars( $recebimento["enviadoPor"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
                    </div>
                  </div>
                </div>
                <?php }else{ ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="alert alert-danger" role="alert">
                      <strong>Ah não!</strong> Este protocolo ainda não tem um recebimento. <a href="/adicionar/recebimento" class="btn btn-danger" data-toggle="tooltip" data-placement="right" title="Cadastrar um recebimento">Cadastrar um recebimento</a>
                    </div>
                  </div>
                </div>
                <?php } ?>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-profile">
              <div class="card-avatar">
                <a href="javascript:;;">
                  <img class="img" src="https://pikmail.herokuapp.com/<?php echo htmlspecialchars( $protocolo["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>?size=150" alt="Sem perfil">
                </a>
              </div>
              <div class="card-body">
                <h6 class="card-category text-gray">Cliente CVA <i class="material-icons">verified_user</i></h6>
                <h4 class="card-title"><?php echo htmlspecialchars( $protocolo["cliente"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h4>
                <p class="card-description">
                  <?php echo htmlspecialchars( $protocolo["endereco"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $protocolo["bairro"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, <?php echo htmlspecialchars( $protocolo["cidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, <?php echo htmlspecialchars( $protocolo["estado"], ENT_COMPAT, 'UTF-8', FALSE ); ?> -
                  <?php echo htmlspecialchars( $protocolo["cep"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <div class="row">
                  <div class="col-md-12">
                    <h4 class="card-title ">Atualizações do protocolo</h4>
                    <p class="card-category">Foram encontrados <strong><?php echo htmlspecialchars( $total, ENT_COMPAT, 'UTF-8', FALSE ); ?></strong> resultados</p>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table estados_protocols">
                    <thead class="text-primary">
                      <th>
                        Estado
                      </th>
                      <th>
                        Data
                      </th>
                      <th>
                        Anexo
                      </th>
                      <th>
                        #
                      </th>
                    </thead>
                    <tbody>
                      <?php if( $estados ){ ?>
                      <?php $counter1=-1;  if( isset($estados) && ( is_array($estados) || $estados instanceof Traversable ) && sizeof($estados) ) foreach( $estados as $key1 => $value1 ){ $counter1++; ?>
                      <tr>
                        <td><?php echo htmlspecialchars( $value1["estado"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($value1["data"])); ?></td>
                        <td>
                          <?php if( $value1["anexo"] != null ){ ?>
                          <a data-image="<?php echo htmlspecialchars( $value1["anexo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="open-img-modal btn btn-primary btn-table" data-toggle="tooltip" data-placement="left"
                            title="Abrir anexo">
                            <i class="material-icons text-white">image</i>
                          </a>
                          <?php }else{ ?>
                          Sem anexo
                          <?php } ?>
                        </td>
                        <td>
                          <a href="/excluir/estado/<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-danger btn-table" data-toggle="tooltip" data-placement="left"
                            title="Excluir">
                            <i class="material-icons">close</i>
                          </a>
                        </td>
                      </tr>
                      <tr>
                      <?php } ?>
                      <?php } ?>
                        <form action="/atualizar/protocolo/<?php echo htmlspecialchars( $protocolo["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post" enctype="multipart/form-data">
                        <td>
                          <div class="form-group">
                            <label class="bmd-label-floating">Estado</label>
                            <input type="text" class="form-control" name="pestado" maxlength="112" required>
                          </div>
                        </td>
                        <td colspan="2">
                          <div class="form-group">
                            <input type="date" class="form-control" name="pdata" required>
                          </div>
                        </td>
                        <td>
                          <div class="form-group" style="display: inline">
                            <label id="label-upload-os" role="button" class="btn btn-warning btn-table" for="opload-os" data-toggle="tooltip" data-placement="left" title="Enviar arquivo">
                              <i class="material-icons">backup</i>
                            </label>
                            <input type="file" class="form-control-file" id="opload-os" name="fileUpload">
                          </div>
                          <button type="submit" class="btn btn-primary btn-table" data-toggle="tooltip" data-placement="left" title="Adicionar">
                            <i class="material-icons">done</i>
                          </button>
                        </td>
                        </form>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>