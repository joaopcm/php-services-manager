<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <div class="row">
                    <div class="col-md-8">
                      <h4 class="card-title ">Usuários</h4>
                      <p class="card-category">Foram encontrados <strong><?php echo htmlspecialchars( $total, ENT_COMPAT, 'UTF-8', FALSE ); ?></strong> resultados</p>
                    </div>
                    <div class="col-md-4 text-right">
                      <?php if( $_SESSION['User']['acessoTotal'] === '1' ){ ?>
                      <a href="/adicionar/usuario" class="btn btn-primary btn-lg">Adicionar Usuário</a>
                      <?php } ?>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table text-center">
                      <?php if( $usuarios ){ ?>
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
                          Usuário
                        </th>
                        <th>
                          Acesso
                        </th>
                      </thead>
                      <tbody>
                        <?php $counter1=-1;  if( isset($usuarios) && ( is_array($usuarios) || $usuarios instanceof Traversable ) && sizeof($usuarios) ) foreach( $usuarios as $key1 => $value1 ){ $counter1++; ?>
                        <tr>
                          <?php if( $_SESSION['User']['acessoTotal'] === '1' ){ ?>
                          <td>
                            <a href="/excluir/usuario/<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-danger btn-table" onclick="return confirm('Deseja realmente excluir este usuário? Case seja um cliente, o mesmo terá somente o usuário de acesso deletado, mas o cadastro de cliente continuará existindo.')" data-toggle="tooltip"
                              data-placement="right" title="Excluir">
                              <i class="material-icons">close</i>
                            </a>
                            <a href="/editar/usuario/<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-success btn-table" data-toggle="tooltip" data-placement="right" title="Editar">
                              <i class="material-icons">edit</i>
                            </a>
                          </td>
                          <?php } ?>
                          <td><?php echo htmlspecialchars( $value1["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                          <td><?php echo htmlspecialchars( $value1["usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                          <td><?php if( $value1["acessoTotal"] === '1' ){ ?>Administrador<?php }elseif( $value1["acessoTotal"] === '0' ){ ?>Somente leitura<?php } ?></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                      <?php }else{ ?>
                      <div class="alert alert-danger" role="alert">
                          <strong>Ah não!</strong> Não existem cadastros de usuários em nossos registros. <a href="/adicionar/usuario" class="btn btn-danger" data-toggle="tooltip" data-placement="right" title="Clique para adicionar um usuário">Cadastrar um usuário</a>
                       </div>
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