# Gerenciador de dados empresariais
Aplicação de gerenciamento de cadastros com tecnologia CRUD, envio de e-mails e painéis anaíticos.

## Variáveis de ambiente
### Aplicação
* __APP_NAME__: Nome da empresa
* __APP_SYSTEM_NAME__: Nome do sistema
* __APP_URL__: URL raíz do projeto
* __APP_VERSION__: Versão do sistema
* __ON_PRODUCTION__: __true__ ou __false__ para configurar o sistema

### Banco de dados
* __MYSQL_USER__: Usuário de acesso ao banco de dados
* __MYSQL_PASSWORD__: Senha de acesso ao banco de dados
* __MYSQL_ROOT_PASSWORD__: Senha de acesso total ao banco de dados
* __MYSQL_DATABASE__: Nome do banco de dados
* __DBHOST__: Servidor do banco de dados

### E-mail
* __MAIL_USERNAME__: Endereço de e-mail que será utilizado para enviar e-mails
* __MAIL_PASSWORD__: Senha do e-mail que será utilizado para enviar e-mails
* __MAIL_PORT__: Porta TLS do servidor do e-mail (587 para GMail)

## Development

Vá para a pasta ./src/ e digite o seguinte comando para baixar as dependências:

```sh
$> composer dump-autoload
```

Em seguida, inicie os contâineres da aplicação e do banco de dados:
```sh
$> docker-compose up -d
```

## Deployment

O deploy será realizado na plataforma do Google, Google Cloud Platform. O processo está em planejamento.

## URLs de acesso
* __Site__: localhost:8080
* __Login__: localhost:8080/login
* __Parte administrativa__: localhost:8080/admin/painel
* __Parte do cliente__: localhost:8080/cliente/%id-do-cliente%
* __Banco de dados (MySQL)__: localhost:3306
* __PhpMyAdmin__: localhost:9000
