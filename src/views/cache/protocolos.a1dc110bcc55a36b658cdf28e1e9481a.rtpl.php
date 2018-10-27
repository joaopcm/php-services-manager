<?php if(!class_exists('Rain\Tpl')){exit;}?><?php if( $protocolos ){ ?>
<div class="modal fade bd-example-modal-lg" id="img-modal" tabindex="-1" role="dialog">
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
<?php } ?>
<div class="content">
  <div class="container-fluid">
    <?php if( $protocolos ){ ?>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header-primary">
            <h4 class="card-title">Consultar protocolo</h4>
          </div>
          <div class="card-body noresults-card">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Protocolo</label>
                  <input type="text" class="form-control" id="pesquisar-protocolo" maxlength="20">
                </div>
              </div>
            </div>
            <div id="row-table-protocols" class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                  <table id="table-protocols" class="table estados_protocols">
                    <thead class=" text-primary">
                      <th>
                        Estado
                      </th>
                      <th>
                        Data
                      </th>
                      <th>
                        Anexo
                      </th>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <div class="row">
              <div class="col-md-8">
                <h4 class="card-title ">Protocolos</h4>
                <p class="card-category">Foram encontrados <strong><?php echo htmlspecialchars( $total, ENT_COMPAT, 'UTF-8', FALSE ); ?></strong> resultados</p>
              </div>
              <div class="col-md-4 text-right">
                <a href="/admin/adicionar/protocolo" class="btn btn-primary btn-lg">Adicionar Protocolo</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <?php if( $protocolos ){ ?>
                <thead class=" text-primary">
                  <th>
                    #
                  </th>
                  <th>
                    Cliente
                  </th>
                  <th>
                    Código
                  </th>
                  <th>
                    Serviço
                  </th>
                  <th>
                    Criado Em
                  </th>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($protocolos) && ( is_array($protocolos) || $protocolos instanceof Traversable ) && sizeof($protocolos) ) foreach( $protocolos as $key1 => $value1 ){ $counter1++; ?>
                  <tr>
                    <td>
                      <form action="/admin/excluir/protocolo/<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
                        <input type="hidden" name="_METHOD" value="DELETE" />
                        <button href="/admin/excluir/protocolo/<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-danger btn-table" onclick="return confirm('Deseja realmente excluir este protocolo?')" data-toggle="tooltip" data-placement="right" title="Excluir">
                          <i class="material-icons">close</i>
                        </button>
                      </form>
                    </td>
                    <td><a href="/admin/visualizar/cliente/<?php echo htmlspecialchars( $value1["idcliente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["cliente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                        <button type="button" class="btn btn-primary btn-table" data-toggle="tooltip" data-placement="right" title="Visualizar cliente">
                          <i class="material-icons">share</i>
                        </button>
                      </a></td>
                    <td><a href="/admin/visualizar/protocolo/<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                        <p id="p<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="display: inline"><?php echo htmlspecialchars( $value1["codigo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
                        <button type="button" class="btn btn-primary btn-table" data-toggle="tooltip" data-placement="right" title="Visualizar protocolo">
                          <i class="material-icons">share</i>
                        </button>
                      </a>
                      <button type="button" class="btn btn-primary btn-table btn-copy-p" data-toggle="tooltip" data-placement="right" title="Copiar protocolo" onclick="copyToClipboard('#p<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>')">
                        <i class="material-icons">file_copy</i>
                      </button></td>
                    <td><?php if( $value1["serivo"] != 'null' ){ ?><?php echo htmlspecialchars( $value1["servico"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php }else{ ?>Serviço deletado<?php } ?></td>
                    <td><?php echo date('d/m/Y', strtotime($value1["data"])); ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
                <?php }else{ ?>
                <div class="alert alert-danger" role="alert">
                  <strong>Ah não!</strong> Não existem protocolos em nossos registros.
                  <a href="/admin/adicionar/protocolo" class="btn btn-danger">Cadastrar um protocolo</a>
                </div>
                <?php } ?>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>