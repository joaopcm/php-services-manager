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
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Visão geral de <?php echo htmlspecialchars( $cliente["nomeCliente"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h4>
            <p class="card-category"><?php echo htmlspecialchars( $cliente["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label class="bmd-label-floating">Nome</label>
                  <input type="text" class="form-control" name="nomeCliente" value="<?php echo htmlspecialchars( $cliente["nomeCliente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="bmd-label-floating">Contato</label>
                  <input type="text" class="form-control" name="contatoLocal" value="<?php echo htmlspecialchars( $cliente["contatoLocal"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="bmd-label-floating">CPF</label>
                  <input type="text" class="form-control" name="cpf" value="<?php echo htmlspecialchars( $cliente["cpf"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">CNPJ</label>
                  <input type="text" class="form-control" name="cnpj" value="<?php echo htmlspecialchars( $cliente["cnpj"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Inscrição Estadual</label>
                  <input type="text" class="form-control" name="inscricaoEstadual" value="<?php echo htmlspecialchars( $cliente["inscricaoEstadual"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Telefone</label>
                  <input type="text" class="form-control" name="telefone" value="<?php echo htmlspecialchars( $cliente["telefone"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Celular</label>
                  <input type="text" class="form-control" name="celular" value="<?php echo htmlspecialchars( $cliente["celular"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="bmd-label-floating">CEP</label>
                  <input type="text" class="form-control" id="cep" name="cep" value="<?php echo htmlspecialchars( $cliente["cep"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label class="bmd-label-floating">Endereço</label>
                  <input type="text" class="form-control" id="endereco" name="endereco" value="<?php echo htmlspecialchars( $cliente["endereco"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Bairro</label>
                  <input type="text" class="form-control" id="bairro" name="bairro" value="<?php echo htmlspecialchars( $cliente["bairro"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Cidade</label>
                  <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo htmlspecialchars( $cliente["cidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Estado</label>
                  <input type="text" class="form-control" id="estado" name="estado" value="<?php echo htmlspecialchars( $cliente["estado"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">E-mail</label>
                  <input type="text" class="form-control" name="email" value="<?php echo htmlspecialchars( $cliente["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Observação</label>
                  <div class="form-group">
                    <textarea class="form-control" rows="3" name="observacao" value="<?php echo htmlspecialchars( $cliente["observacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Tipo</label>
                  <input type="text" class="form-control" name="tipo" value="<?php echo htmlspecialchars( $cliente["tipo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-profile">
              <div class="card-avatar">
                <a href="javascript:;;">
                  <img class="img" src="https://pikmail.herokuapp.com/<?php echo htmlspecialchars( $cliente["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>?size=150" alt="Sem perfil">
                </a>
              </div>
              <div class="card-body">
                <h6 class="card-category text-gray">Cliente <?php echo getenv('APP_NAME'); ?> <i class="material-icons">verified_user</i></h6>
                <h4 class="card-title"><?php echo htmlspecialchars( $cliente["nomeCliente"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h4>
                <p class="card-description">
                  <?php echo htmlspecialchars( $cliente["endereco"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $cliente["bairro"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, <?php echo htmlspecialchars( $cliente["cidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, <?php echo htmlspecialchars( $cliente["estado"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $cliente["cep"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
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
                    <h4 class="card-title ">Protocolos cadastrados no nome de <?php echo htmlspecialchars( $cliente["nomeCliente"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h4>
                    <p class="card-category">Foram encontrados <strong><?php echo htmlspecialchars( $total, ENT_COMPAT, 'UTF-8', FALSE ); ?></strong> resultados</p>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table text-center">
                    <?php if( $protocolos ){ ?>
                    <thead class=" text-primary">
                      <th>
                        Data de Cadastro
                      </th>
                      <th>
                        Protocolo
                      </th>
                      <th>
                        Serviço
                      </th>
                      <th>
                        Valor do Boleto
                      </th>
                      <th>
                        Data de Vencimento
                      </th>
                      <th>
                        Data de Compensação
                      </th>
                      <th>
                        Estado
                      </th>
                      <th>
                        Nº do Boleto
                      </th>
                      <th>
                        Forma de Pagamento
                      </th>
                      <th>
                        Forma de Envio
                      </th>
                      <th>
                        Parcelas
                      </th>
                    </thead>
                    <tbody>
                      <?php $counter1=-1;  if( isset($protocolos) && ( is_array($protocolos) || $protocolos instanceof Traversable ) && sizeof($protocolos) ) foreach( $protocolos as $key1 => $value1 ){ $counter1++; ?>
                      <tr>
                        <td><?php echo date('d/m/Y', strtotime($value1["dataCadastro"])); ?></td>
                        <?php if( $_SESSION['User']['is_admin'] === true ){ ?>
                        <td><a href="/admin/visualizar/protocolo/<?php echo htmlspecialchars( $value1["idprotocolo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                            <span id="p<?php echo htmlspecialchars( $value1["idprotocolo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["codigo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                            <button type="button" class="btn btn-primary btn-table" data-toggle="tooltip" data-placement="right" title="Visualizar protocolo">
                              <i class="material-icons">share</i>
                            </button>
                          </a><button type="button" class="btn btn-primary btn-table btn-copy-p" data-toggle="tooltip" data-placement="right" title="Copiar protocolo" onclick="copyToClipboard('#p<?php echo htmlspecialchars( $value1["idprotocolo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>')">
                            <i class="material-icons">file_copy</i>
                          </button></td>
                        <?php }else{ ?>
                        <td>
                          <span id="p<?php echo htmlspecialchars( $value1["idprotocolo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["codigo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span><button type="button" class="btn btn-primary btn-table btn-copy-p" data-toggle="tooltip" data-placement="right" title="Copiar protocolo" onclick="copyToClipboard('#p<?php echo htmlspecialchars( $value1["idprotocolo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>')">
                            <i class="material-icons">file_copy</i>
                          </button></td>
                        <?php } ?>

                        <td><?php if( $value1["servico"] != '' ){ ?><?php echo htmlspecialchars( $value1["servico"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php }else{ ?>Serviço deletado<?php } ?></td>
                        <td><strong><?php if( $value1["valorBoleto"] != '' ){ ?>R$ <?php echo number_format($value1["valorBoleto"], 2, ',', '.'); ?><?php } ?></strong></td>
                        <td>
                          <?php if( $value1["dataVencimento"] != '' ){ ?>
                          <?php echo date('d/m/Y', strtotime($value1["dataVencimento"])); ?>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if( $value1["dataCompensacao"] != '' ){ ?>
                          <?php echo date('d/m/Y', strtotime($value1["dataCompensacao"])); ?>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if( $value1["dataCompensacao"] != '' ){ ?>
                          <span style="font-weight: bold; color:green;">Pago</span>
                          <?php }else{ ?>
                          <?php if( $value1["dataVencimento"] != '' ){ ?>
                          <?php $d1 = strtotime($value1["dataVencimento"]); ?>
                          <?php $d2 = strtotime(date('Y-m-d')); ?>
                          <?php $dataFinal = ($d2 - $d1) / 86400; ?>
                          <?php if( $dataFinal < 0 ){ ?> <?php $dataFinal=$dataFinal * -1; ?> <span style="font-weight: bold; color:orange;"><?php echo htmlspecialchars( $dataFinal, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                            dias restantes</span>
                            <?php }else{ ?>
                            <span style="font-weight: bold; color: red;"><?php echo htmlspecialchars( $dataFinal, ENT_COMPAT, 'UTF-8', FALSE ); ?> dias atrasados</span>
                            <?php } ?>
                            <?php } ?>
                            <?php } ?>
                        </td>
                        <td><?php if( $value1["nBoleto"] != '' ){ ?><?php echo htmlspecialchars( $value1["nBoleto"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?></td>
                        <td><?php if( $value1["formaPagamento"] != '' ){ ?><?php echo htmlspecialchars( $value1["formaPagamento"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?></td>
                        <td><?php if( $value1["formaEnvio"] != '' ){ ?><?php echo htmlspecialchars( $value1["formaEnvio"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?></td>
                        <td><?php if( $value1["parcelas"] != '' ){ ?><?php echo htmlspecialchars( $value1["parcelas"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                    <?php }else{ ?>
                    <div class="alert alert-danger" role="alert">
                      <strong>Ah não!</strong> <?php echo htmlspecialchars( $cliente["nomeCliente"], ENT_COMPAT, 'UTF-8', FALSE ); ?> ainda não realizou negócios com a CVA
                      Climatização. <a href="http://www.cvaclimatizacao.com.br" class="btn btn-danger" data-toggle="tooltip" data-placement="right" title="Realizar negócios com a CVA Climatização!">Começe por aqui!</a>
                    </div>
                </div>
                <?php } ?>
                </table>
              </div>
            </div>
          </div>
          <?php if( $protocolos ){ ?>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Consultar protocolo</h4>
                  <p class="card-category">Digite o código de um protocolo para consultar seu estado</p>
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
                            <td>
                              Anexo
                            </td>
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
        </div>
      </div>
    </div>
  </div>
</div>
</div>