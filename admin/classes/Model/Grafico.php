<?php

/*
* Classe responsável por todas as ações
* relacionadas aos serviços da CVA
*/

namespace CVA\Model;

use \CVA\DB\Sql;

class Grafico {

    /* Função responsábel pela população do gráfico de clientes */
    public static function clientesMesChart()
    {
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

    /* Função responsável pela população do gráfico monetário */
    public static function recebimentosMesChart()
    {
        $sql = new Sql();
        $query = "SELECT
                    (SELECT SUM(valorBoleto) FROM tb_recebimentos WHERE dataCompensacao != '' AND dataRecebimento BETWEEN CONCAT(YEAR(NOW()),'-01-01') AND CONCAT(YEAR(NOW()),'-01-31')) AS jan,
                    (SELECT SUM(valorBoleto) FROM tb_recebimentos WHERE dataCompensacao != '' AND dataRecebimento BETWEEN CONCAT(YEAR(NOW()),'-02-01') AND CONCAT(YEAR(NOW()),'-02-31')) AS fev,
                    (SELECT SUM(valorBoleto) FROM tb_recebimentos WHERE dataCompensacao != '' AND dataRecebimento BETWEEN CONCAT(YEAR(NOW()),'-03-01') AND CONCAT(YEAR(NOW()),'-03-31')) AS mar,
                    (SELECT SUM(valorBoleto) FROM tb_recebimentos WHERE dataCompensacao != '' AND dataRecebimento BETWEEN CONCAT(YEAR(NOW()),'-04-01') AND CONCAT(YEAR(NOW()),'-04-31')) AS abr,
                    (SELECT SUM(valorBoleto) FROM tb_recebimentos WHERE dataCompensacao != '' AND dataRecebimento BETWEEN CONCAT(YEAR(NOW()),'-05-01') AND CONCAT(YEAR(NOW()),'-05-31')) AS mai,
                    (SELECT SUM(valorBoleto) FROM tb_recebimentos WHERE dataCompensacao != '' AND dataRecebimento BETWEEN CONCAT(YEAR(NOW()),'-06-01') AND CONCAT(YEAR(NOW()),'-06-31')) AS jun,
                    (SELECT SUM(valorBoleto) FROM tb_recebimentos WHERE dataCompensacao != '' AND dataRecebimento BETWEEN CONCAT(YEAR(NOW()),'-07-01') AND CONCAT(YEAR(NOW()),'-07-31')) AS jul,
                    (SELECT SUM(valorBoleto) FROM tb_recebimentos WHERE dataCompensacao != '' AND dataRecebimento BETWEEN CONCAT(YEAR(NOW()),'-08-01') AND CONCAT(YEAR(NOW()),'-08-31')) AS ago,
                    (SELECT SUM(valorBoleto) FROM tb_recebimentos WHERE dataCompensacao != '' AND dataRecebimento BETWEEN CONCAT(YEAR(NOW()),'-09-01') AND CONCAT(YEAR(NOW()),'-09-31')) AS _set,
                    (SELECT SUM(valorBoleto) FROM tb_recebimentos WHERE dataCompensacao != '' AND dataRecebimento BETWEEN CONCAT(YEAR(NOW()),'-10-01') AND CONCAT(YEAR(NOW()),'-10-31')) AS _out,
                    (SELECT SUM(valorBoleto) FROM tb_recebimentos WHERE dataCompensacao != '' AND dataRecebimento BETWEEN CONCAT(YEAR(NOW()),'-11-01') AND CONCAT(YEAR(NOW()),'-11-31')) AS nov,
                    (SELECT SUM(valorBoleto) FROM tb_recebimentos WHERE dataCompensacao != '' AND dataRecebimento BETWEEN CONCAT(YEAR(NOW()),'-12-01') AND CONCAT(YEAR(NOW()),'-12-31')) AS dez,
                    (SELECT SUM(valorBoleto) FROM tb_recebimentos WHERE dataCompensacao != '' AND dataRecebimento BETWEEN CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') AND CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-31')  ) AS valor_atual,
                    (SELECT SUM(valorBoleto) FROM tb_recebimentos WHERE dataCompensacao != '' AND dataRecebimento BETWEEN CONCAT(YEAR(NOW()),'-',MONTH(NOW()) - 1,'-01') AND CONCAT(YEAR(NOW()),'-',MONTH(NOW()) - 1,'-31')  ) AS valor_anterior,
                    (SELECT valor_atual / valor_anterior) AS multiplicador,
                    (SELECT( IF (valor_atual < valor_anterior, multiplicador * 100, multiplicador * 100 - 100) )) AS porcentagem,
                    (SELECT valor_atual - valor_anterior) AS diferencial,
                    -- (SELECT max(valorBoleto) FROM tb_recebimentos) AS maior_valor
                    (SELECT SUM(valorBoleto) FROM tb_clientes WHERE dataCadastro BETWEEN CONCAT(YEAR(NOW()), '-01-01') AND CONCAT('2018-', MONTH(NOW()), '-', '31') LIMIT 1) AS maior_valor
                FROM tb_recebimentos
                LIMIT 1";
        $results = $sql->select($query);
        return $results;
    }

}

?>