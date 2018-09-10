SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

DELIMITER  //

CREATE PROCEDURE `sp_clientes_delete` (`pid` INT(6))  BEGIN

	DELETE FROM tb_clientes WHERE id = pid;

END //

CREATE PROCEDURE `sp_clientes_save` (IN `pnomeCliente` VARCHAR(56), IN `pcontatoLocal` VARCHAR(56), IN `pcpf` VARCHAR(14), IN `pcnpj` VARCHAR(18), IN `pinscricaoEstadual` VARCHAR(15), IN `ptelefone` VARCHAR(56), IN `pcelular` VARCHAR(56), IN `pcep` VARCHAR(9), IN `pendereco` VARCHAR(112), IN `pbairro` VARCHAR(56), IN `pcidade` VARCHAR(56), IN `pestado` VARCHAR(2), IN `pemail` VARCHAR(56), IN `pobservacao` VARCHAR(112), IN `ptipo` VARCHAR(2), IN `palteradoPor` VARCHAR(56), IN `palteradoEm` VARCHAR(16))  BEGIN

	INSERT INTO tb_clientes (nomeCliente, contatoLocal, cpf, cnpj, inscricaoEstadual, telefone, celular, cep, endereco, bairro, cidade, estado, email, observacao, tipo, alteradoPor, alteradoEm)
			VALUES (pnomeCliente, pcontatoLocal, pcpf, pcnpj, pinscricaoEstadual, ptelefone, pcelular, pcep, pendereco, pbairro, pcidade, pestado, pemail, pobservacao, ptipo, palteradoPor,     palteradoEm);

	SELECT * FROM tb_clientes;

END //

CREATE PROCEDURE `sp_clientes_update` (IN `pid` INT(6), IN `pnomeCliente` VARCHAR(56), IN `pcontatoLocal` VARCHAR(56), IN `pcpf` VARCHAR(14), IN `pcnpj` VARCHAR(18), IN `pinscricaoEstadual` VARCHAR(15), IN `ptelefone` VARCHAR(56), IN `pcelular` VARCHAR(56), IN `pcep` VARCHAR(9), IN `pendereco` VARCHAR(112), IN `pbairro` VARCHAR(56), IN `pcidade` VARCHAR(56), IN `pestado` VARCHAR(2), IN `pemail` VARCHAR(56), IN `pobservacao` VARCHAR(112), IN `ptipo` VARCHAR(2), IN `palteradoPor` VARCHAR(56), IN `palteradoEm` VARCHAR(16))  BEGIN

	UPDATE tb_clientes
		SET nomeCliente = pnomeCliente,
			contatoLocal = pcontatoLocal,
            cpf = pcpf,
            cnpj = pcnpj,
            inscricaoEstadual = pinscricaoEstadual,
            telefone = ptelefone,
            celular = pcelular,
            cep = pcep,
            endereco = pendereco,
            bairro = pbairro,
            cidade = pcidade,
            estado = pestado,
            email = pemail,
            observacao = pobservacao,
            tipo = ptipo,
            alteradoPor = palteradoPor,
            alteradoEm = palteradoEm
		WHERE id = pid;
        
	SELECT * FROM tb_clientes;

END //

CREATE PROCEDURE `sp_recebimentos_delete` (IN `pid` INT(6))  NO SQL
BEGIN

	DELETE FROM tb_recebimentos WHERE id = pid;

END //

CREATE PROCEDURE `sp_recebimentos_save` (IN `pdataRecebimento` VARCHAR(10), IN `pfornecedor` VARCHAR(56), IN `pvalorBoleto` VARCHAR(10), IN `pdataVencimento` VARCHAR(10), IN `pdataCompensacao` VARCHAR(10), IN `pnBoleto` VARCHAR(15), IN `pformaPagamento` VARCHAR(25), IN `pquantidade` VARCHAR(3), IN `preferente` VARCHAR(112), IN `pformaEnvio` VARCHAR(25), IN `penviadoPor` VARCHAR(56), IN `pmes` INT(2), IN `pano` INT(4), IN `palteradoPor` VARCHAR(56), IN `palteradoEm` VARCHAR(16))  NO SQL
BEGIN

	INSERT INTO tb_recebimentos (dataRecebimento, fornecedor, valorBoleto, dataVencimento, dataCompensacao, nBoleto, formaPagamento, quantidade, referente, formaEnvio, enviadoPor, mes, ano, alteradoPor, alteradoEm)
			VALUES (pdataRecebimento, pfornecedor, pvalorBoleto, pdataVencimento, pdataCompensacao, pnBoleto, pformaPagamento, pquantidade, preferente, pformaEnvio, penviadoPor, pmes, pano, palteradoPor, palteradoEm);

	SELECT * FROM tb_recebimentos;

END //

CREATE PROCEDURE `sp_recebimentos_update` (IN `pid` INT(6), IN `pdataRecebimento` VARCHAR(10), IN `pfornecedor` VARCHAR(56), IN `pvalorBoleto` VARCHAR(10), IN `pdataVencimento` VARCHAR(10), IN `pdataCompensacao` VARCHAR(10), IN `pnBoleto` VARCHAR(15), IN `pformaPagamento` VARCHAR(25), IN `pquantidade` VARCHAR(3), IN `preferente` VARCHAR(112), IN `pformaEnvio` VARCHAR(25), IN `penviadoPor` VARCHAR(56), IN `palteradoPor` VARCHAR(56), IN `palteradoEm` VARCHAR(16))  NO SQL
BEGIN

	UPDATE tb_recebimentos
		SET dataRecebimento = pdataRecebimento,
			fornecedor = pfornecedor,
            valorBoleto = pvalorBoleto,
            dataVencimento = pdataVencimento,
            dataCompensacao = pdataCompensacao,
            nBoleto = pnBoleto,
            formaPagamento = pformaPagamento,
            quantidade = pquantidade,
            referente = preferente,
            formaEnvio = pformaEnvio,
            enviadoPor = penviadoPor,
            alteradoPor = palteradoPor,
            alteradoEm = palteradoEm
		WHERE id = pid;
        
	SELECT * FROM tb_recebimentos;

END //

CREATE PROCEDURE `sp_usuarios_delete` (IN `pid` INT(6))  NO SQL
BEGIN

	DELETE FROM tb_usuarios WHERE id = pid;

END //

CREATE PROCEDURE `sp_usuarios_save` (IN `pnome` VARCHAR(56), IN `pusuario` VARCHAR(25), IN `psenha` VARCHAR(32), IN `pacessoTotal` TINYINT(1))  NO SQL
BEGIN

	INSERT INTO tb_usuarios (nome, usuario, senha, acessoTotal)
    	VALUES (pnome, pusuario, psenha, pacessoTotal);
        
    SELECT * FROM tb_usuarios;

END //

CREATE PROCEDURE `sp_usuarios_update` (IN `pid` INT(6), IN `pnome` VARCHAR(56), IN `pusuario` VARCHAR(25), IN `psenha` VARCHAR(32), IN `pacessoTotal` TINYINT(1))  NO SQL
BEGIN

	UPDATE tb_usuarios
		SET nome = pnome,
			usuario = pusuario,
            senha = psenha,
            acessoTotal = pacessoTotal
		WHERE id = pid;
        
	SELECT * FROM tb_usuarios;

END //

DELIMITER ;

CREATE TABLE `tb_clientes` (
  `id` int(6) NOT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nomeCliente` varchar(56) NOT NULL,
  `contatoLocal` varchar(56) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `cnpj` varchar(18) DEFAULT NULL,
  `inscricaoEstadual` varchar(15) DEFAULT NULL,
  `telefone` varchar(56) DEFAULT NULL,
  `celular` varchar(56) DEFAULT NULL,
  `cep` varchar(9) DEFAULT NULL,
  `endereco` varchar(112) DEFAULT NULL,
  `bairro` varchar(56) DEFAULT NULL,
  `cidade` varchar(56) DEFAULT NULL,
  `estado` varchar(56) DEFAULT NULL,
  `email` varchar(56) DEFAULT NULL,
  `observacao` varchar(112) DEFAULT NULL,
  `tipo` varchar(2) DEFAULT NULL,
  `alteradoPor` varchar(25) NOT NULL,
  `alteradoEm` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tb_recebimentos` (
  `id` int(6) NOT NULL,
  `dataRecebimento` varchar(10) NOT NULL,
  `fornecedor` varchar(56) NOT NULL,
  `valorBoleto` varchar(10) NOT NULL,
  `dataVencimento` varchar(10) NOT NULL,
  `dataCompensacao` varchar(10) DEFAULT NULL,
  `nBoleto` varchar(15) DEFAULT NULL,
  `formaPagamento` varchar(25) DEFAULT NULL,
  `quantidade` varchar(3) DEFAULT NULL,
  `referente` varchar(112) DEFAULT NULL,
  `formaEnvio` varchar(25) DEFAULT NULL,
  `enviadoPor` varchar(56) DEFAULT NULL,
  `mes` int(2) NOT NULL,
  `ano` int(4) NOT NULL,
  `alteradoPor` varchar(56) NOT NULL,
  `alteradoEm` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tb_usuarios` (
  `id` int(6) NOT NULL,
  `nome` varchar(56) NOT NULL,
  `usuario` varchar(25) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `acessoTotal` tinyint(1) DEFAULT '0',
  `dataCadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tb_usuarios` (`id`, `nome`, `usuario`, `senha`, `acessoTotal`, `dataCadastro`) VALUES
(1, 'CVA ClimatizaÃ§Ã£o', 'cva', '21232f297a57a5a743894a0e4a801fc3', 1, '2018-09-09 01:06:30'),
(2, 'FuncionÃ¡rio', 'funcionario', 'cc7a84634199040d54376793842fe035', 0, '2018-09-10 21:27:14');

ALTER TABLE `tb_clientes`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tb_recebimentos`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tb_clientes`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `tb_recebimentos`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `tb_usuarios`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
