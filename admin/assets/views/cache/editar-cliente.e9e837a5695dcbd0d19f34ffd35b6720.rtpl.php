<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Editar Cliente</h4>
                  <p class="card-category">Edite um cliente para a CVA Climatização</p>
                </div>
                <div class="card-body">
                  <form action="/editar/cliente/<?php echo htmlspecialchars( $cliente["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="POST">
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nome</label>
                          <input type="text" class="form-control" name="nomeCliente" value="<?php echo htmlspecialchars( $cliente["nomeCliente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" maxlength="56" required>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Contato</label>
                          <input type="text" class="form-control" name="contatoLocal" value="<?php echo htmlspecialchars( $cliente["contatoLocal"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" maxlength="56">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">CPF</label>
                          <input type="text" class="form-control" name="cpf" value="<?php echo htmlspecialchars( $cliente["cpf"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" data-mask="000.000.000-00">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">CNPJ</label>
                          <input type="text" class="form-control" name="cnpj" value="<?php echo htmlspecialchars( $cliente["cnpj"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" data-mask="00.000.000/0000-00">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Inscrição Estadual</label>
                          <input type="text" class="form-control" name="inscricaoEstadual" value="<?php echo htmlspecialchars( $cliente["inscricaoEstadual"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" maxlength="56">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Telefone</label>
                          <input type="text" class="form-control" name="telefone" value="<?php echo htmlspecialchars( $cliente["telefone"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" maxlength="56">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Celular</label>
                          <input type="text" class="form-control" name="celular" value="<?php echo htmlspecialchars( $cliente["celular"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" maxlength="56">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">CEP</label>
                          <input type="text" class="form-control" id="cep" name="cep" value="<?php echo htmlspecialchars( $cliente["cep"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                        </div>
                      </div>
                      <div class="col-md-8">
                        <div class="form-group">
                          <label class="bmd-label-floating">Endereço</label>
                          <input type="text" class="form-control" id="endereco" name="endereco" value="<?php echo htmlspecialchars( $cliente["endereco"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" maxlength="112">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Bairro</label>
                          <input type="text" class="form-control" id="bairro" name="bairro" value="<?php echo htmlspecialchars( $cliente["bairro"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" maxlength="56">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Cidade</label>
                          <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo htmlspecialchars( $cliente["cidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" maxlength="56">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Estado</label>
                          <select class="form-control" name="estado" id="estado" />
                            <option value="">Selecione</option>
                            <option value="AC" <?php if( $cliente["estado"] === 'AC' ){ ?>selected<?php } ?>>Acre</option>
                            <option value="AL" <?php if( $cliente["estado"] === 'AL' ){ ?>selected<?php } ?>>Alagoas</option>
                            <option value="AP" <?php if( $cliente["estado"] === 'AP' ){ ?>selected<?php } ?>>Amapá</option>
                            <option value="AM" <?php if( $cliente["estado"] === 'AM' ){ ?>selected<?php } ?>>Amazonas</option>
                            <option value="BA" <?php if( $cliente["estado"] === 'BA' ){ ?>selected<?php } ?>>Bahia</option>
                            <option value="CE" <?php if( $cliente["estado"] === 'CE' ){ ?>selected<?php } ?>>Ceará</option>
                            <option value="DF" <?php if( $cliente["estado"] === 'DF' ){ ?>selected<?php } ?>>Distrito Federal</option>
                            <option value="GO" <?php if( $cliente["estado"] === 'GO' ){ ?>selected<?php } ?>>Goiás</option>
                            <option value="ES" <?php if( $cliente["estado"] === 'ES' ){ ?>selected<?php } ?>>Espírito Santo</option>
                            <option value="MA" <?php if( $cliente["estado"] === 'MA' ){ ?>selected<?php } ?>>Maranhão</option>
                            <option value="MT" <?php if( $cliente["estado"] === 'MT' ){ ?>selected<?php } ?>>Mato Grosso</option>
                            <option value="MS" <?php if( $cliente["estado"] === 'MS' ){ ?>selected<?php } ?>>Mato Grosso do Sul</option>
                            <option value="MG" <?php if( $cliente["estado"] === 'MG' ){ ?>selected<?php } ?>>Minas Gerais</option>
                            <option value="PA" <?php if( $cliente["estado"] === 'PA' ){ ?>selected<?php } ?>>Pará</option>
                            <option value="PB" <?php if( $cliente["estado"] === 'PB' ){ ?>selected<?php } ?>>Paraiba</option>
                            <option value="PR" <?php if( $cliente["estado"] === 'PR' ){ ?>selected<?php } ?>>Paraná</option>
                            <option value="PE" <?php if( $cliente["estado"] === 'PE' ){ ?>selected<?php } ?>>Pernambuco</option>
                            <option value="PI" <?php if( $cliente["estado"] === 'PI' ){ ?>selected<?php } ?>>Piauí­</option>
                            <option value="RJ" <?php if( $cliente["estado"] === 'RJ' ){ ?>selected<?php } ?>>Rio de Janeiro</option>
                            <option value="RN" <?php if( $cliente["estado"] === 'RN' ){ ?>selected<?php } ?>>Rio Grande do Norte</option>
                            <option value="RS" <?php if( $cliente["estado"] === 'RS' ){ ?>selected<?php } ?>>Rio Grande do Sul</option>
                            <option value="RO" <?php if( $cliente["estado"] === 'RO' ){ ?>selected<?php } ?>>Rondônia</option>
                            <option value="RR" <?php if( $cliente["estado"] === 'RR' ){ ?>selected<?php } ?>>Roraima</option>
                            <option value="SP" <?php if( $cliente["estado"] === 'SP' ){ ?>selected<?php } ?>>São Paulo</option>
                            <option value="SC" <?php if( $cliente["estado"] === 'SC' ){ ?>selected<?php } ?>>Santa Catarina</option>
                            <option value="SE" <?php if( $cliente["estado"] === 'SE' ){ ?>selected<?php } ?>>Sergipe</option>
                            <option value="TO" <?php if( $cliente["estado"] === 'TO' ){ ?>selected<?php } ?>>Tocantins</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">E-mail Principal</label>
                          <input type="email" class="form-control" name="email"  value="<?php echo htmlspecialchars( $cliente["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" maxlength="56">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">E-mails Secundários</label>
                          <input type="text" class="form-control" name="emails"  value="<?php echo htmlspecialchars( $cliente["emails"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" maxlength="224">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Observação</label>
                          <div class="form-group">
                            <label class="bmd-label-floating"> Digite uma observação sobre o cliente.</label>
                            <textarea class="form-control" rows="3" name="observacao"  value="<?php echo htmlspecialchars( $cliente["observacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" maxlength="112"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Tipo</label>
                          <select class="form-control" name="tipo" />
                            <option value="PF" <?php if( $cliente["tipo"] === 'PF' ){ ?>selected<?php } ?>>Pessoa Física</option>
                            <option value="PJ" <?php if( $cliente["tipo"] === 'PJ' ){ ?>selected<?php } ?>>Pessoa Jurídica</option>
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