<?php

/*
* Classe responsável por todas as ações
* relacionadas aos serviços da CVA
*/

namespace CVA\Model;

use \CVA\DB\Sql;

class Grafico {

    public function clientesMesChart() {
        $sql = new Sql();
        $query = "SELECT
                    (SELECT IF(COUNT(id) = 0, NULL, COUNT(id) + (SELECT COUNT(id) FROM tb_clientes WHERE dataCadastro BETWEEN CONCAT(YEAR(NOW()) - 1, '-12-01') AND CONCAT(YEAR(NOW()) - 1, '-12-31'))) FROM tb_clientes WHERE dataCadastro BETWEEN CONCAT(YEAR(NOW()), '-01-01') AND CONCAT(YEAR(NOW()), '-01-31')) AS cJaneiro,
                    (SELECT IF(COUNT(id) = 0, NULL, COUNT(id) + (SELECT COUNT(id) FROM tb_clientes WHERE dataCadastro BETWEEN CONCAT(YEAR(NOW()), '-01-01') AND CONCAT(YEAR(NOW()), '-01-31'))) FROM tb_clientes WHERE dataCadastro BETWEEN CONCAT(YEAR(NOW()), '-02-01') AND CONCAT(YEAR(NOW()), '-02-31')) AS cFevereiro,
                    (SELECT IF(COUNT(id) = 0, NULL, COUNT(id) + (SELECT COUNT(id) FROM tb_clientes WHERE dataCadastro BETWEEN CONCAT(YEAR(NOW()), '-01-01') AND CONCAT(YEAR(NOW()), '-02-31'))) FROM tb_clientes WHERE dataCadastro BETWEEN CONCAT(YEAR(NOW()), '-03-01') AND CONCAT(YEAR(NOW()), '-03-31')) AS cMarco,
                    (SELECT IF(COUNT(id) = 0, NULL, COUNT(id) + (SELECT COUNT(id) FROM tb_clientes WHERE dataCadastro BETWEEN CONCAT(YEAR(NOW()), '-01-01') AND CONCAT(YEAR(NOW()), '-03-31'))) FROM tb_clientes WHERE dataCadastro BETWEEN CONCAT(YEAR(NOW()), '-04-01') AND CONCAT(YEAR(NOW()), '-04-31')) AS cAbril,
                    (SELECT IF(COUNT(id) = 0, NULL, COUNT(id) + (SELECT COUNT(id) FROM tb_clientes WHERE dataCadastro BETWEEN CONCAT(YEAR(NOW()), '-01-01') AND CONCAT(YEAR(NOW()), '-04-31'))) FROM tb_clientes WHERE dataCadastro BETWEEN CONCAT(YEAR(NOW()), '-05-01') AND CONCAT(YEAR(NOW()), '-05-31')) AS cMaio,
                    (SELECT IF(COUNT(id) = 0, NULL, COUNT(id) + (SELECT COUNT(id) FROM tb_clientes WHERE dataCadastro BETWEEN CONCAT(YEAR(NOW()), '-01-01') AND CONCAT(YEAR(NOW()), '-05-31'))) FROM tb_clientes WHERE dataCadastro BETWEEN CONCAT(YEAR(NOW()), '-06-01') AND CONCAT(YEAR(NOW()), '-06-31')) AS cJunho,
                    (SELECT IF(COUNT(id) = 0, NULL, COUNT(id) + (SELECT COUNT(id) FROM tb_clientes WHERE dataCadastro BETWEEN CONCAT(YEAR(NOW()), '-01-01') AND CONCAT(YEAR(NOW()), '-06-31'))) FROM tb_clientes WHERE dataCadastro BETWEEN CONCAT(YEAR(NOW()), '-07-01') AND CONCAT(YEAR(NOW()), '-07-31')) AS cJulho,
                    (SELECT IF(COUNT(id) = 0, NULL, COUNT(id) + (SELECT COUNT(id) FROM tb_clientes WHERE dataCadastro BETWEEN CONCAT(YEAR(NOW()), '-01-01') AND CONCAT(YEAR(NOW()), '-07-31'))) FROM tb_clientes WHERE dataCadastro BETWEEN CONCAT(YEAR(NOW()), '-08-01') AND CONCAT(YEAR(NOW()), '-08-31')) AS cAgosto,
                    (SELECT IF(COUNT(id) = 0, NULL, COUNT(id) + (SELECT COUNT(id) FROM tb_clientes WHERE dataCadastro BETWEEN CONCAT(YEAR(NOW()), '-01-01') AND CONCAT(YEAR(NOW()), '-08-31'))) FROM tb_clientes WHERE dataCadastro BETWEEN CONCAT(YEAR(NOW()), '-09-01') AND CONCAT(YEAR(NOW()), '-09-31')) AS cSetembro,
                    (SELECT IF(COUNT(id) = 0, NULL, COUNT(id) + (SELECT COUNT(id) FROM tb_clientes WHERE dataCadastro BETWEEN CONCAT(YEAR(NOW()), '-01-01') AND CONCAT(YEAR(NOW()), '-09-31'))) FROM tb_clientes WHERE dataCadastro BETWEEN CONCAT(YEAR(NOW()), '-10-01') AND CONCAT(YEAR(NOW()), '-10-31')) AS cOutubro,
                    (SELECT IF(COUNT(id) = 0, NULL, COUNT(id) + (SELECT COUNT(id) FROM tb_clientes WHERE dataCadastro BETWEEN CONCAT(YEAR(NOW()), '-01-01') AND CONCAT(YEAR(NOW()), '-10-31'))) FROM tb_clientes WHERE dataCadastro BETWEEN CONCAT(YEAR(NOW()), '-11-01') AND CONCAT(YEAR(NOW()), '-11-31')) AS cNovembro,
                    (SELECT IF(COUNT(id) = 0, NULL, COUNT(id) + (SELECT COUNT(id) FROM tb_clientes WHERE dataCadastro BETWEEN CONCAT(YEAR(NOW()), '-01-01') AND CONCAT(YEAR(NOW()), '-11-31'))) FROM tb_clientes WHERE dataCadastro BETWEEN CONCAT(YEAR(NOW()), '-12-01') AND CONCAT(YEAR(NOW()), '-12-31')) AS cDezembro,
                    (SELECT COUNT(id) FROM tb_clientes WHERE dataCadastro BETWEEN CONCAT(YEAR(NOW()), '-01-01') AND CONCAT('2018-', MONTH(NOW()) - 1, '-', '31')) AS mesesAnteriores,
                    (SELECT IF(COUNT(id) = 0, NULL, COUNT(id)) FROM tb_clientes WHERE dataCadastro BETWEEN CONCAT(YEAR(NOW()), '-', MONTH(NOW()),'-01') AND CONCAT(YEAR(NOW()), '-', MONTH(NOW()),'-31')) AS esteMes,
                    (SELECT CONCAT(((SELECT IF(COUNT(id) = 0, NULL, COUNT(id)) FROM tb_clientes WHERE dataCadastro BETWEEN CONCAT(YEAR(NOW()), '-', MONTH(NOW()),'-01') AND CONCAT(YEAR(NOW()), '-', MONTH(NOW()), '-31')) / (SELECT COUNT(id) FROM tb_clientes WHERE dataCadastro BETWEEN CONCAT('2018-', MONTH(NOW()) - 1, '-', '01') AND CONCAT('2018-', MONTH(NOW()) - 1, '-', '31'))) * 100)) AS diferencial,
                    (SELECT COUNT(id) FROM tb_clientes WHERE dataCadastro BETWEEN CONCAT(YEAR(NOW()), '-01-01') AND CONCAT('2018-', MONTH(NOW()), '-', '31')) AS total
                FROM tb_clientes
                LIMIT 1;";
        $results = $sql->select($query);
        return $results;
    }

}

?>