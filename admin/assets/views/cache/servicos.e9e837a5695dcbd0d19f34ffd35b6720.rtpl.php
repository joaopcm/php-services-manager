<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <div class="row">
              <div class="col-md-8">
                <h4 class="card-title ">Serviços</h4>
                <p class="card-category">Foram encontrados <strong><?php echo htmlspecialchars( $total, ENT_COMPAT, 'UTF-8', FALSE ); ?></strong> resultados</p>
              </div>
              <div class="col-md-4 text-right">
                <?php if( $_SESSION['User']['acessoTotal'] === '1' ){ ?>
                <a href="/adicionar/servico" class="btn btn-primary btn-lg">Adicionar Serviço</a>
                <?php } ?>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <?php if( $servicos ){ ?>
                <thead class=" text-primary">
                  <?php if( $_SESSION['User']['acessoTotal'] === '1' ){ ?>
                  <th>
                    #
                  </th>
                  <?php } ?>
                  <th>
                    Título do Serviço
                  </th>
                  <th>
                    Criado Em
                  </th>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($servicos) && ( is_array($servicos) || $servicos instanceof Traversable ) && sizeof($servicos) ) foreach( $servicos as $key1 => $value1 ){ $counter1++; ?>
                  <tr>
                    <?php if( $_SESSION['User']['acessoTotal'] === '1' ){ ?>
                    <td>
                      <a href="/excluir/servico/<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-danger btn-table" onclick="return confirm('Deseja realmente excluir este serviço?')" data-toggle="tooltip"
                        data-placement="right" title="Excluir">
                        <i class="material-icons">close</i>
                      </a>
                      <a href="/editar/servico/<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-success btn-table" data-toggle="tooltip" data-placement="right" title="Editar">
                        <i class="material-icons">edit</i>
                      </a>
                    </td>
                    <?php } ?>
                    <td><?php echo htmlspecialchars( $value1["titulo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($value1["dataCadastro"])); ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
                <?php }else{ ?>
                <div class="alert alert-danger" role="alert">
                  <strong>Ah não!</strong> Não existem serviços em nossos registros.
                  <a href="/adicionar/servico" class="btn btn-danger">Cadastrar um serviço</a>
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