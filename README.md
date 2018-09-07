# Gerenciador de clientes da CVA Climatização
Aplicação de gerenciamento de cadastros com tecnologia CRUD.

## Variáveis de ambiente
* __MYSQL_USER__: Usuário de acesso ao banco de dados
* __MYSQL_PASSWORD__: Senha de acesso ao banco de dados
* __MYSQL_DATABASE__: Nome do banco de dados

## Desenvolvimento

Tendo como base este repositório como diretório raíz do projeto, digite primeiramente o seguinte comando:

```sh
$> composer update
```

Em seguida, gere e execute a imagem Docker da aplicação com o seguinte comando:
```sh
$> docker-compose up
```
Caso tenha problemas com diretórios em cache no momento da geração e execução da imagem, execute o seguinte comando:
```sh
$> docker rm -v {volume}
```

Após executar o comando acima, gere e execute a imagem Docker da aplicação normalmente.