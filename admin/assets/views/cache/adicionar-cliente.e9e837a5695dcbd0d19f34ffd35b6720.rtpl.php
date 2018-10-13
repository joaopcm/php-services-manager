<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Adicionar Cliente</h4>
            <p class="card-category">Cadastre um cliente para a CVA Climatização</p>
          </div>
          <div class="card-body">
            <form action="/adicionar/cliente" method="POST">
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label class="bmd-label-floating">Nome</label>
                    <input type="text" class="form-control" name="nomeCliente" maxlength="56" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="bmd-label-floating">Contato</label>
                    <input type="text" class="form-control" name="contatoLocal" maxlength="56">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">CPF</label>
                    <input type="text" class="form-control" name="cpf" data-mask="000.000.000-00">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">CNPJ</label>
                    <input type="text" class="form-control" name="cnpj" data-mask="00.000.000/0000-00">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Inscrição Estadual</label>
                    <input type="text" class="form-control" name="inscricaoEstadual" maxlength="56">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Telefone</label>
                    <input type="text" class="form-control" name="telefone" maxlength="56">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Celular</label>
                    <input type="text" class="form-control" name="celular" maxlength="56">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">CEP</label>
                    <input type="text" class="form-control" id="cep" name="cep">
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating">Endereço</label>
                    <input type="text" class="form-control" id="endereco" name="endereco" maxlength="112">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Bairro</label>
                    <input type="text" class="form-control" id="bairro" name="bairro" maxlength="56">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Cidade</label>
                    <input type="text" class="form-control" id="cidade" name="cidade" maxlength="56">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Estado</label>
                    <select class="form-control" name="estado" id="estado" />
                      <option value="">Selecione</option>
                      <option value="AC">Acre</option>
                      <option value="AL">Alagoas</option>
                      <option value="AP">Amapá</option>
                      <option value="AM">Amazonas</option>
                      <option value="BA">Bahia</option>
                      <option value="CE">Ceará</option>
                      <option value="DF">Distrito Federal</option>
                      <option value="GO">Goiás</option>
                      <option value="ES">Espírito Santo</option>
                      <option value="MA">Maranhão</option>
                      <option value="MT">Mato Grosso</option>
                      <option value="MS">Mato Grosso do Sul</option>
                      <option value="MG">Minas Gerais</option>
                      <option value="PA">Pará</option>
                      <option value="PB">Paraiba</option>
                      <option value="PR">Paraná</option>
                      <option value="PE">Pernambuco</option>
                      <option value="PI">Piauí­</option>
                      <option value="RJ">Rio de Janeiro</option>
                      <option value="RN">Rio Grande do Norte</option>
                      <option value="RS">Rio Grande do Sul</option>
                      <option value="RO">Rondônia</option>
                      <option value="RR">Roraima</option>
                      <option value="SP">São Paulo</option>
                      <option value="SC">Santa Catarina</option>
                      <option value="SE">Sergipe</option>
                      <option value="TO">Tocantins</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">E-mail Principal</label>
                    <input type="email" class="form-control" name="email" maxlength="56">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">E-mails Secundários</label>
                    <input type="text" class="form-control" name="emails" maxlength="224">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Observação</label>
                    <div class="form-group">
                      <label class="bmd-label-floating"> Digite uma observação sobre o cliente.</label>
                      <textarea class="form-control" rows="3" name="observacao" maxlength="112"></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Tipo</label>
                    <select class="form-control" name="tipo" />
                      <option value="PF">Pessoa Física</option>
                      <option value="PJ">Pessoa Jurídica</option>
                    </select>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary pull-right">Adicionar</button>
              <div class="clearfix"></div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>