<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <div class="row">
              <div class="col-md-8">
                <h4 class="card-title ">Clientes</h4>
                <p class="card-category">Foram encontrados <strong><?php echo htmlspecialchars( $total, ENT_COMPAT, 'UTF-8', FALSE ); ?></strong> resultados</p>
              </div>
              <div class="col-md-4 text-right">
                <?php if( $_SESSION['User']['acessoTotal'] === '1' ){ ?>
                <a href="/admin/adicionar/cliente" class="btn btn-primary btn-lg">Adicionar Cliente</a>
                <?php } ?>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <?php if( $clientes ){ ?>
                <thead class=" text-primary">
                  <?php if( $_SESSION['User']['acessoTotal'] === '1' ){ ?>
                  <th>
                    #
                  </th>
                  <?php } ?>
                  <th>
                    Nome
                  </th>
                  <th>
                    Contato
                  </th>
                  <th>
                    CPF
                  </th>
                  <th>
                    CNPJ
                  </th>
                  <th>
                    Ins Estadual
                  </th>
                  <th>
                    Telefone
                  </th>
                  <th>
                    Celular
                  </th>
                  <th>
                    CEP
                  </th>
                  <th>
                    Endereço
                  </th>
                  <th>
                    Bairro
                  </th>
                  <th>
                    Cidade
                  </th>
                  <th>
                    Estado
                  </th>
                  <th>
                    E-mail Principal
                  </th>
                  <th>
                    E-mails Secundários
                  </th>
                  <th>
                    Observação
                  </th>
                  <th>
                    Tipo
                  </th>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($clientes) && ( is_array($clientes) || $clientes instanceof Traversable ) && sizeof($clientes) ) foreach( $clientes as $key1 => $value1 ){ $counter1++; ?>
                  <tr>
                    <?php if( $_SESSION['User']['acessoTotal'] === '1' ){ ?>
                    <td>
                      <form action="/admin/excluir/cliente/<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
                      <input type="hidden" name="_METHOD" value="DELETE"/>
                      <button type="submit" class="btn btn-danger btn-table" onclick="return confirm('Deseja realmente excluir este cliente?')" data-toggle="tooltip"
                        data-placement="right" title="Excluir">
                        <i class="material-icons">close</i>
                      </button>
                      </form>
                      <a href="/admin/editar/cliente/<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-success btn-table" data-toggle="tooltip" data-placement="right" title="Editar">
                        <i class="material-icons">edit</i>
                      </a>
                      <a  href="javascript:;;" class="btn btn-info btn-table" data-toggle="tooltip" data-placement="right" title="Última vez alterado por <?php echo htmlspecialchars( $value1["alteradoPor"], ENT_COMPAT, 'UTF-8', FALSE ); ?> em <?php echo date('d/m/Y', strtotime($value1["alteradoEm"])); ?> às <?php echo date('H:i', strtotime($value1["alteradoEm"])); ?>">
                        <i class="material-icons">history</i>
                      </a>
                    </td>
                    <?php } ?>
                    <td>
                      <a href="/admin/visualizar/cliente/<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nomeCliente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                      <button type="button" class="btn btn-primary btn-table" data-toggle="tooltip" data-placement="right" title="Visualizar cliente">
                        <i class="material-icons">share</i>
                      </button>
                      </a>
                      <button type="button" href="javascript:;;" class="btn btn-primary btn-table" data-toggle="tooltip" data-placement="right" title="<?php echo htmlspecialchars( $value1["usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php echo htmlspecialchars( $value1["senha"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                        <i class="material-icons">lock</i>
                      </button>
                    </td>
                    <td><?php echo htmlspecialchars( $value1["contatoLocal"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["cpf"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["cnpj"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["inscricaoEstadual"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["telefone"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["celular"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["cep"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["endereco"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["bairro"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["cidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["estado"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["emails"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["observacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["tipo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
                <?php }else{ ?>
                <div class="alert alert-danger" role="alert">
                  <strong>Ah não!</strong> Não existem clientes em nossos registros.
                  <a href="/admin/adicionar/cliente" class="btn btn-danger">Cadastrar um cliente</a>
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