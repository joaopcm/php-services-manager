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
                <a href="/admin/adicionar/servico" class="btn btn-primary btn-lg">Adicionar Serviço</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <?php if( $servicos ){ ?>
                <thead class=" text-primary">
                  <th>
                    #
                  </th>
                  <th>
                    Título do Serviço
                  </th>
                  <th>
                    Avaliação Média
                  </th>
                  <th>
                    Criado Em
                  </th>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($servicos) && ( is_array($servicos) || $servicos instanceof Traversable ) && sizeof($servicos) ) foreach( $servicos as $key1 => $value1 ){ $counter1++; ?>
                  <tr>
                    <td>
                      <form action="/admin/excluir/servico/<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
                      <input type="hidden" name="_METHOD" value="DELETE"/>
                      <button type="submit" class="btn btn-danger btn-table" onclick="return confirm('Deseja realmente excluir este serviço?')" data-toggle="tooltip"
                        data-placement="right" title="Excluir">
                        <i class="material-icons">close</i>
                      </button>
                      </form>
                      <a href="/admin/editar/servico/<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-success btn-table" data-toggle="tooltip" data-placement="right" title="Editar">
                        <i class="material-icons">edit</i>
                      </a>
                    </td>
                    <td><?php echo htmlspecialchars( $value1["titulo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td>
                      <?php if( $value1["avaliacao"] == '' ){ ?>
                      Não avaliado
                      <?php }else{ ?>
                      <?php echo round($value1["avaliacao"], 2); ?> ⭐
                      <button type="button" class="btn btn-primary btn-table open-modal__ca" service-id="<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" data-toggle="tooltip" data-placement="right" title="Ver avaliação unitária">
                        <i class="material-icons">list</i>
                      </button>
                      <?php } ?>
                    </td>
                    <td><?php echo date('d/m/Y', strtotime($value1["dataCadastro"])); ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
                <?php }else{ ?>
                <div class="alert alert-danger" role="alert">
                  <strong>Ah não!</strong> Não existem serviços em nossos registros.
                  <a href="/admin/adicionar/servico" class="btn btn-danger">Cadastrar um serviço</a>
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
<div class="modal fade" id="modal__ca" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-body text-center">
				<table class="table table-sm">
					<thead>
							<th scope="col">Cliente</th>
              <th scope="col">Nota</th>
              <th scope="col">Observação</th>
					</thead>
					<tbody class="modal__ca-to-be-inserted">
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>