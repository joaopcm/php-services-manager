<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <div class="row">
              <div class="col-md-8">
                <h4 class="card-title ">Recebimentos de <?php echo htmlspecialchars( $mes, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $ano, ENT_COMPAT, 'UTF-8', FALSE ); ?></h4>
                <p class="card-category">Foram encontrados <strong><?php echo htmlspecialchars( $total, ENT_COMPAT, 'UTF-8', FALSE ); ?></strong> resultados</p>
              </div>
              <div class="col-md-4 text-right">
                <a href="/admin/adicionar/recebimento" class="btn btn-primary btn-lg">Adicionar Recebimento</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table text-center">
                <?php if( $recebimentos ){ ?>
                <thead class=" text-primary">
                  <th>
                    #
                  </th>
                  <th>
                    Data de Recebimento
                  </th>
                  <th>
                    Cliente
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
                    Parcelas
                  </th>
                  <th>
                    Referência
                  </th>
                  <th>
                    Forma de Envio
                  </th>
                  <th>
                    Enviado Por
                  </th>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($recebimentos) && ( is_array($recebimentos) || $recebimentos instanceof Traversable ) && sizeof($recebimentos) ) foreach( $recebimentos as $key1 => $value1 ){ $counter1++; ?>
                  <tr>
                    <td>
                      <form action="/admin/excluir/recebimento/<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
                        <input type="hidden" name="_METHOD" value="DELETE"/>
                        <button type="submit" class="btn btn-danger btn-table" onclick="return confirm('Deseja realmente excluir este recebimento?')" data-toggle="tooltip" data-placement="right" title="Excluir">
                          <i class="material-icons">close</i>
                        </button>
                      </form>
                      <?php if( $value1["cliente"] != null ){ ?>
                      <a href="/admin/editar/recebimento/<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-success btn-table" data-toggle="tooltip" data-placement="right" title="Editar">
                        <i class="material-icons">edit</i>
                      </a>
                      <?php } ?>
                      <a href="javascript:;;" class="btn btn-info btn-table" data-toggle="tooltip" data-placement="right" title="Última vez alterado por <?php echo htmlspecialchars( $value1["alteradoPor"], ENT_COMPAT, 'UTF-8', FALSE ); ?> em <?php echo date( 'd/m/Y' , strtotime($value1["alteradoEm"])); ?> às <?php echo date('H:i', strtotime($value1["alteradoEm"])); ?>">
                        <i class="material-icons">history</i>
                      </a>
                    </td>
                    <td><?php echo date('d/m/Y', strtotime($value1["dataRecebimento"])); ?></td>
                    <td>
                      <?php if( $value1["cliente"] === null ){ ?> Cadastro deletado <?php }else{ ?>
                      <a href="/admin/visualizar/cliente/<?php echo htmlspecialchars( $value1["idcliente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["cliente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                        <button type="button" class="btn btn-primary btn-table" data-toggle="tooltip" data-placement="right" title="Visualizar cliente">
                          <i class="material-icons">share</i>
                        </button>
                      </a><?php } ?>
                    </td>
                    <td>
                      <?php if( $value1["codigo"] === null ){ ?> Cadastro deletado <?php }else{ ?>
                      <a href="/admin/visualizar/protocolo/<?php echo htmlspecialchars( $value1["idprotocolo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                        <p id="p<?php echo htmlspecialchars( $value1["idprotocolo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="display: inline"><?php echo htmlspecialchars( $value1["codigo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
                        <button type="button" class="btn btn-primary btn-table" data-toggle="tooltip" data-placement="right" title="Visualizar protocolo">
                          <i class="material-icons">share</i>
                        </button>
                      </a>
                      <button type="button" class="btn btn-primary btn-table btn-copy-p" data-toggle="tooltip" data-placement="right" title="Copiar protocolo" onclick="copyToClipboard('#p<?php echo htmlspecialchars( $value1["idprotocolo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>')">
                        <i class="material-icons">file_copy</i>
                      </button><?php } ?>
                    </td>
                    <td>
                      <?php if( $value1["servico"] === null ){ ?> Cadastro deletado <?php }else{ ?> <?php echo htmlspecialchars( $value1["servico"], ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php } ?>
                    </td>
                    <td>R$ <?php echo number_format($value1["valorBoleto"], 2, ',', '.'); ?></td>
                    <td>
                      <?php if( $value1["dataVencimento"] != '' ){ ?> <?php echo date('d/m/Y', strtotime($value1["dataVencimento"])); ?> <?php } ?>
                    </td>
                    <td>
                      <?php if( $value1["dataCompensacao"] != '' ){ ?> <?php echo date('d/m/Y', strtotime($value1["dataCompensacao"])); ?> <?php } ?>
                    </td>
                    <td>
                      <?php if( $value1["dataCompensacao"] != '' ){ ?>
                      <span style="font-weight: bold; color:green;">Pago 😊</span> <?php }else{ ?> <?php $d1 = strtotime($value1["dataVencimento"]); ?> <?php $d2 = strtotime(date('Y-m-d')); ?> <?php $dataFinal = ($d2 - $d1) / 86400; ?><?php if( $dataFinal
                      < 0  ){ ?><?php $dataFinal = $dataFinal * -1; ?>
                              <span style=" font-weight: bold; color:orange; "><?php echo htmlspecialchars( $dataFinal, ENT_COMPAT, 'UTF-8', FALSE ); ?> dias restantes 🤔</span>
                          <?php }else{ ?>
                              <span style=" font-weight: bold; color: red; "><?php echo htmlspecialchars( $dataFinal, ENT_COMPAT, 'UTF-8', FALSE ); ?> dias atrasados 😤</span>
                          <?php } ?>
                      <?php } ?>
                    </td>
                    <td><?php echo htmlspecialchars( $value1["nBoleto"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["formaPagamento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["parcelas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["referencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["formaEnvio"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["enviadoPor"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
                <?php }else{ ?>
                <div class=" alert alert-danger " role=" alert">
                        <strong>Ah não!</strong> Não existem cadastros de recebimentos em <strong><?php echo htmlspecialchars( $mes, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $ano, ENT_COMPAT, 'UTF-8', FALSE ); ?></strong> em nossos registros. <a href="/admin/adicionar/recebimento " class=" btn btn-danger " data-toggle=" tooltip " data-placement=" right " title=" ATENÇÃO! Cadastrar um novo recebimento não irá preencher a base de dados de <?php echo htmlspecialchars( $mes, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $ano, ENT_COMPAT, 'UTF-8', FALSE ); ?>! ">Cadastrar um recebimento</a>
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