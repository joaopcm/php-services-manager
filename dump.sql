-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: 09-Set-2018 às 01:53
-- Versão do servidor: 5.7.23
-- versão do PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cva`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_clientes_delete` (`pid` INT(6))  BEGIN

	DELETE FROM tb_clientes WHERE id = pid;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_clientes_save` (IN `pnomeCliente` VARCHAR(56), IN `pcontatoLocal` VARCHAR(56), IN `pcpf` VARCHAR(14), IN `pcnpj` VARCHAR(18), IN `pinscricaoEstadual` VARCHAR(15), IN `ptelefone` VARCHAR(56), IN `pcelular` VARCHAR(56), IN `pcep` VARCHAR(9), IN `pendereco` VARCHAR(112), IN `pbairro` VARCHAR(56), IN `pcidade` VARCHAR(56), IN `pestado` VARCHAR(2), IN `pemail` VARCHAR(56), IN `pobservacao` VARCHAR(112), IN `ptipo` VARCHAR(2), IN `palteradoPor` VARCHAR(56), IN `palteradoEm` VARCHAR(16))  BEGIN

	INSERT INTO tb_clientes (nomeCliente, contatoLocal, cpf, cnpj, inscricaoEstadual, telefone, celular, cep, endereco, bairro, cidade, estado, email, observacao, tipo, alteradoPor, alteradoEm)
			VALUES (pnomeCliente, pcontatoLocal, pcpf, pcnpj, pinscricaoEstadual, ptelefone, pcelular, pcep, pendereco, pbairro, pcidade, pestado, pemail, pobservacao, ptipo, palteradoPor,     palteradoEm);

	SELECT * FROM tb_clientes;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_clientes_update` (IN `pid` INT(6), IN `pnomeCliente` VARCHAR(56), IN `pcontatoLocal` VARCHAR(56), IN `pcpf` VARCHAR(14), IN `pcnpj` VARCHAR(18), IN `pinscricaoEstadual` VARCHAR(15), IN `ptelefone` VARCHAR(56), IN `pcelular` VARCHAR(56), IN `pcep` VARCHAR(9), IN `pendereco` VARCHAR(112), IN `pbairro` VARCHAR(56), IN `pcidade` VARCHAR(56), IN `pestado` VARCHAR(2), IN `pemail` VARCHAR(56), IN `pobservacao` VARCHAR(112), IN `ptipo` VARCHAR(2), IN `palteradoPor` VARCHAR(56), IN `palteradoEm` VARCHAR(16))  BEGIN

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

END$$

CREATE DEFINER=`root`@`%` PROCEDURE `sp_recebimentos_delete` (IN `pid` INT(6))  NO SQL
BEGIN

	DELETE FROM tb_recebimentos WHERE id = pid;

END$$

CREATE DEFINER=`root`@`%` PROCEDURE `sp_recebimentos_save` (IN `pdataRecebimento` VARCHAR(10), IN `pfornecedor` VARCHAR(56), IN `pvalorBoleto` VARCHAR(10), IN `pdataVencimento` VARCHAR(10), IN `pdataCompensacao` VARCHAR(10), IN `pnBoleto` VARCHAR(15), IN `pformaPagamento` VARCHAR(25), IN `pquantidade` VARCHAR(3), IN `preferente` VARCHAR(112), IN `pformaEnvio` VARCHAR(25), IN `penviadoPor` VARCHAR(56), IN `pmes` INT(2), IN `pano` INT(4), IN `palteradoPor` VARCHAR(56), IN `palteradoEm` VARCHAR(16))  NO SQL
BEGIN

	INSERT INTO tb_recebimentos (dataRecebimento, fornecedor, valorBoleto, dataVencimento, dataCompensacao, nBoleto, formaPagamento, quantidade, referente, formaEnvio, enviadoPor, mes, ano, alteradoPor, alteradoEm)
			VALUES (pdataRecebimento, pfornecedor, pvalorBoleto, pdataVencimento, pdataCompensacao, pnBoleto, pformaPagamento, pquantidade, preferente, pformaEnvio, penviadoPor, pmes, pano, palteradoPor, palteradoEm);

	SELECT * FROM tb_recebimentos;

END$$

CREATE DEFINER=`root`@`%` PROCEDURE `sp_recebimentos_update` (IN `pid` INT(6), IN `pdataRecebimento` VARCHAR(10), IN `pfornecedor` VARCHAR(56), IN `pvalorBoleto` VARCHAR(10), IN `pdataVencimento` VARCHAR(10), IN `pdataCompensacao` VARCHAR(10), IN `pnBoleto` VARCHAR(15), IN `pformaPagamento` VARCHAR(25), IN `pquantidade` VARCHAR(3), IN `preferente` VARCHAR(112), IN `pformaEnvio` VARCHAR(25), IN `penviadoPor` VARCHAR(56), IN `palteradoPor` VARCHAR(56), IN `palteradoEm` VARCHAR(16))  NO SQL
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

END$$

CREATE DEFINER=`root`@`%` PROCEDURE `sp_usuarios_delete` (IN `pid` INT(6))  NO SQL
BEGIN

	DELETE FROM tb_usuarios WHERE id = pid;

END$$

CREATE DEFINER=`root`@`%` PROCEDURE `sp_usuarios_save` (IN `pnome` VARCHAR(56), IN `pusuario` VARCHAR(25), IN `psenha` VARCHAR(32), IN `pacessoTotal` TINYINT(1))  NO SQL
BEGIN

	INSERT INTO tb_usuarios (nome, usuario, senha, acessoTotal)
    	VALUES (pnome, pusuario, psenha, pacessoTotal);
        
    SELECT * FROM tb_usuarios;

END$$

CREATE DEFINER=`root`@`%` PROCEDURE `sp_usuarios_update` (IN `pid` INT(6), IN `pnome` VARCHAR(56), IN `pusuario` VARCHAR(25), IN `psenha` VARCHAR(32), IN `pacessoTotal` TINYINT(1))  NO SQL
BEGIN

	UPDATE tb_usuarios
		SET nome = pnome,
			usuario = pusuario,
            senha = psenha,
            acessoTotal = pacessoTotal
		WHERE id = pid;
        
	SELECT * FROM tb_usuarios;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_clientes`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_clientes`
--

INSERT INTO `tb_clientes` (`id`, `dataCadastro`, `nomeCliente`, `contatoLocal`, `cpf`, `cnpj`, `inscricaoEstadual`, `telefone`, `celular`, `cep`, `endereco`, `bairro`, `cidade`, `estado`, `email`, `observacao`, `tipo`, `alteradoPor`, `alteradoEm`) VALUES
(1, '2018-09-07 23:04:43', 'FLAVIO DUARTE ALVAREZ ', '', '226.057.048-82', '', '', '', '947713717 - Flavio ', '01548020', 'RUA MARIANO PROCOPIO 201 APTO 83 ', 'VILA MONUMENTO', 'SÃO PAULO', 'SP', '', 'NAUTILUS AA25', NULL, 'Admin', '07/09/2018 21:08'),
(2, '2018-09-07 23:04:43', 'COND EDIF SAN DEMETRIO', '', '', '10.157.789/0001-31', '', '2276-2837 Portaria', '99808-6728 - Luisinho Zelador ', '04143-010', 'RUA ITAPIRU 572', 'SAUDE', 'SAO PAULO', 'SP', 'cipriano.suely@gmail.com', 'HELIOTEK ', NULL, 'Admin', '07/09/2018 21:08'),
(3, '2018-09-07 23:04:43', 'CONDOMINIO RESIDENCIAL ITAPEMA', '', '', '15.562.263/0001-61', '', '', '97148-8257 Geremias Zelador / 99185-5239 Neusa Sindica', '03087000', 'RUA SAO JORGE 125', 'PQ SÃO JORGE', 'SAO PAULO', 'SP', 'sindicaitapema1820@gmail.com', '1 TP300 E 1 HT20', NULL, 'Admin', '07/09/2018 21:08'),
(4, '2018-09-07 23:04:43', 'SHIRLEY - MAE DO LEO', '', '', '', '', '', '99972-1811 Shirley', '', 'NA RUA DOS BOMBEIROS', 'Jd vila Formosa ', 'SAO PAULO', 'SP', '', '1 ASTER TEEN ', NULL, 'Admin', '07/09/2018 21:08'),
(5, '2018-09-07 23:04:43', 'IGREJA EVANGELICA ASSEMBLEIA DE DEUS ', '', '', '11.681.222/0001-33', '', '2721-3181 ', '94928-1511 Pastor Miranda / 94616-7499 Luis Pastor ', '', 'RUA TRAVESSA TIGREZA 82', 'JARDIM DA CONQUISTA ', 'SAO PAULO', 'SP', '', 'AR CONDICIONADO - 1 TRI SPLIT GREE 1 SPLIT ELETROLUX 1 SPLIT SPRINGER (TODOS R22)', NULL, 'Admin', '07/09/2018 21:08'),
(6, '2018-09-07 23:04:43', 'COND NEW ORLEANS ', '', '', '61.864.021/0001-40', '', '5044-2385', '', '', 'RUA BACAETAVA 121', 'VILA GERTUDES ', 'SÃO PAULO', 'SP', 'neworleans.sindico@gmail.com', 'TP1000', NULL, 'Admin', '07/09/2018 21:08'),
(7, '2018-09-07 23:04:43', 'COND ENERGY BROOKLIN', '', '', '', '', '', '94010-2755 Nilton Zelador ', '', 'RUA JACERU 346', 'VL GERTUDES', 'SÃO PAUO', 'SP', 'niltonccn@hotmail.com', '', NULL, 'Admin', '07/09/2018 21:08'),
(8, '2018-09-07 23:04:43', 'ColÃ©gio Albert Sabin', '', '715.822.580-00', '', '', '', '', '', 'AV DARCY REIS ', 'PQ DES PRINCES', '', 'SP', 'eder@albertsabin.com.br', '', '', 'Admin', '2018/09/08 20:39'),
(9, '2018-09-07 23:04:43', 'COND L\'ESPACE', '', '', '21.600.316/0001-94', '', '2539-2759', '96306-0455 Marisio Zelador', '', 'RUA PAULO FRANCO 194', 'VILA HAMBURGUESA', 'SAO PAULO', 'SP', 'marisio.farias120@gmail.com', 'PLACA SOLAR ', NULL, 'Admin', '07/09/2018 21:08'),
(10, '2018-09-07 23:04:43', 'CONDOMINIO WIDE VIEW', '', '', '', '', '4508-4462', '96307-2017 Daniel Zelador', '', 'RUA MARIA ANTONIA LADALARDO 20', 'JD FONTE DO MORUMBI', 'SAO PAULO', 'SP', 'gestor.wideview@outlook.com', '1 HT14 E 1 HT20', NULL, 'Admin', '07/09/2018 21:08'),
(11, '2018-09-07 23:04:43', 'SUELI MOLLES - RODOLFO SANTOS', '', '199.703.409-30', '', '', '3758-1262', '99555-4445 Rodolfo ', '', 'RUA FORTE WILLIAM 140 APTO 231', 'VILA ANDRADE', 'SAO PAULO', 'SP', 'sms.molles@gmail.com', 'SODRAMAR SD80', NULL, 'Admin', '07/09/2018 21:08'),
(12, '2018-09-07 23:04:43', 'CONDOMINIO PARQUE PANAMBY', '', '', '09.575.958/0001-85', '', '3758-5203', '', '', 'RUA FORTE WILLIAM 100', 'JD FONTE DO MORUMBI', 'SAO PAULO', 'SP', 'condominioparquepanamby@gmail.com', '3 HT', NULL, 'Admin', '07/09/2018 21:08'),
(13, '2018-09-07 23:04:43', 'CONDOMINIO RESERVA DO BOSQUE', '', '', '17.882.162/0001-01', '', '2331-3056', '95460-1915 - Inácio Zelador ', '04191-190', 'RUA ANTONIO JOSE VAZ 177', 'JD CARAGUATA ', 'SAO PAULO', 'SP', 'y_lavelle@hotmail.com ,  sacramentobitencurt@gmail.com', 'BOMBA ', NULL, 'Admin', '07/09/2018 21:08'),
(14, '2018-09-07 23:04:43', 'CONDOMINIO MURANO ', '', '', '07.504.540/0001-51', '', '', '99453-2232 ', '', 'AL SARUTAIA 392', 'JD PAULISTA ', 'SÃO PAULO', 'SP', 'condominiomurano@yahoo.com.br', 'TP1000 E TP1400', NULL, 'Admin', '07/09/2018 21:08'),
(15, '2018-09-07 23:04:43', 'ACADEMIA PROGRESS (RUNNER)', '', '', '000.749.270-00', '', '', '99910-3838 Jorge ', '', 'RUA SIQUEIRA BUENO 1085 ', 'MOOCA', '', 'SP', 'jorgelprogress@gmail.com', '', 'PJ', 'CVA', '2018/09/08 21:22'),
(16, '2018-09-07 23:04:43', 'ACADEMIA ROBRUEL ', '', '', '11.761.940/0001-10', '', '3536-6006', '95205-7807 Amanda', '', 'AV INCONFIDENCIA MINEIRA ', 'VILA RICA ', 'SÃO PAULO', 'SP', 'neworleans.sindico@gmail.com', '', NULL, 'Admin', '07/09/2018 21:08'),
(17, '2018-09-07 23:04:43', 'CONDOMINIO VX CHANCE JARDINS ', 'SELSO ZELADOR OU CAMILA ADM', '', '23.389.140/0001-07', '', '2838-0697 / 3191 5073 ADM', '', '01423-010', 'R BATATAES 76', 'JARDIM PAULISTA', 'SÃO PAULO', 'SP', 'camila.barros@oma.com.br', 'SD 160 YES', NULL, 'Admin', '07/09/2018 21:08'),
(18, '2018-09-07 23:04:43', 'LUCELIA ', '', '', '', '', '', '98426-2004 Lucelia', '', 'RUA ROBELIA 635', 'JARDIM PRUDENCIA', 'SÃO PAULO', 'SP', 'lca205@gmail.com', '', NULL, 'Admin', '07/09/2018 21:08'),
(19, '2018-09-07 23:04:43', 'LUCIDALVA', '', '', '', '', '', '99527-4395 LUCIDALVA', '', 'ESTRADA LARAMARA 3575', 'VILA GRAZIELA', 'MAIRIPORÃ', 'SP', 'lucidalva.leao@gmail.com', 'BOMBA, SOLAR', NULL, 'Admin', '07/09/2018 21:08'),
(20, '2018-09-07 23:04:43', 'MARIA EUGENIA / LITTON GARCIA', '', '011.716.338-40', '', '', '', '99705-3377 Litton', '06429-245', 'ALAMEDA TAFÉ 231', 'MORADA DOS LAGOS', 'BARUERI', 'SP', 'littonleal@yahoo.com.br', 'TP650+ JAZUZZI SOLAR', NULL, 'Admin', '07/09/2018 21:08'),
(21, '2018-09-07 23:04:43', 'CONDOMINIO PERDIZES HOUSE', '', '', '60.908.894/0001-44', '', '', '96733-7792 DAVI ZELADOR', '', 'RUA TAGIPURU 127', 'PERDIZES', 'SÃO PAULO', 'SP', 'perdizeshouse127@gmail.com', 'HT20', NULL, 'Admin', '07/09/2018 21:08'),
(22, '2018-09-07 23:04:43', 'CONDOMINIO VILLAGIO ACQUA BIANCA', '', '', '13.320.020/0001-91', '', '3675-3626', '', '05006-020', 'RUA ITAPICURU 870', 'PERDIZES', 'SÃO PAULO', 'SP', 'fernando.abrao@uol.com.br', '', NULL, 'Admin', '07/09/2018 21:08'),
(23, '2018-09-07 23:04:43', 'RAQUEL LONGATTO', 'RAQUEL', '285.043.598-83', '', '', '', '97140-1490', '06704-500', 'ESTRADA CARLOS ANTONIO PEREIRA DE CASTRO 3471 CASA 160 - DENTRO COND TERRAS DE SÃO FERNANDO', 'COTIA', 'COTIA', 'SP', '', 'AS-25', NULL, 'Admin', '07/09/2018 21:08'),
(24, '2018-09-07 23:04:43', 'COND RESIDENCIAL RAIZES', 'HENRIQUE/SHIRO', '', '', '', '', '99919-5760/ 97212-2292', '', 'RUA MARIA JOSE DE BELLEGARDE SANTONI 135', 'PQ RENATO MAIA', 'GUARULHOS', 'SP', 'fantgas@hotmail.com', '', NULL, 'Admin', '07/09/2018 21:08'),
(25, '2018-09-07 23:04:43', 'CAMILA VENTURA ', '', '369.119.518-01', '', '', '2451-0206', '94002-4430 VENTURA ', '', 'RUA CACHARA C44 COND AGUAS DE IGARATÁ ', 'IGARATA', 'IGARATA', 'SP', '', 'NAUTILUS P 115 AT2', NULL, 'Admin', '07/09/2018 21:08'),
(26, '2018-09-07 23:04:43', 'ADRIANA', 'LUCIANA', '', '', '', '4192-3897', '98732-6776', '', 'AL DOS ANTURIOS 779', 'MORADA DAS FLORES', 'BARUERI', 'SP', 'supermercado.tokio@hotmail.com', '', NULL, 'Admin', '07/09/2018 21:08'),
(27, '2018-09-07 23:04:43', 'COND QUEEN ELIZABETH ', '', '', '', '', '', '', '', 'RUA ELIZABETH BARBEGIAN BALDINATO 99', 'VILA SUZANA', 'SAO PAULO', 'SP', '', '', NULL, 'Admin', '07/09/2018 21:08'),
(28, '2018-09-07 23:04:43', 'FÃ‰LIX ACACIO TANNURE', '', '', '', '', '5093-3133', '94031-1154', '', 'TRAVESSA UBIRASSANGA 45 ', 'CAMPO BELO', '', 'SP', '', '', '', 'Admin', '07/09/2018 21:08'),
(29, '2018-09-07 23:04:43', 'MICHELE MURANO JUNIOR', 'MICHELE', '256.770.668-26', '', '', '', '97261-0153', '', 'RUA DO GOLF B 898 - COND COSTA VERDE ', '', 'CARAGUATATUBA', 'SP', 'michelejr@joalmi.com.br', 'NAUTILUS', NULL, 'Admin', '07/09/2018 21:08'),
(30, '2018-09-07 23:04:43', 'Edson Geoges Nassar', 'Isabel ou Orlando ( gás) ', '114.581.988-55', '', '', '', '98136-2354 Isabel ', '', 'Rua Forte William 100 - Apartamento 212 Bloco 1', 'Morumbi ', 'São Paulo', 'SP', '', 'NAUTILUS AA45', NULL, 'Admin', '07/09/2018 21:08'),
(31, '2018-09-07 23:04:43', 'Romeu ', '', '', '', '', '', '', '', 'Rua Artur Bernardes 323', 'Vila Invernada', 'são paulo', 'sp', '', '', NULL, 'Admin', '07/09/2018 21:08'),
(32, '2018-09-07 23:04:43', 'CONDOMIO ESPAÃ‡O A RESIDENCE ', 'MAURICIO', '', '092.781.350-00', '', '4332-6734', '97150-2905', '09732-580', 'RUA MORVAM DIAS DE FIGUEIREDO 155', 'VILA DEYSE ', '', 'SP', '', '', '', 'Admin', '07/09/2018 21:08'),
(33, '2018-09-07 23:04:43', 'CONDOMINIO PORTAL NATHALIE', '', '', '21.212.999/0001-02', '', '', '95861-9133', '', 'RUA JOSE DE ANDRADE FIGUEIRA 217', 'VILA SUZANA', 'SÃO PAULO', 'SP', 'portalnathalie217@gmai.com', 'JELLY FISHER VC180', NULL, 'Admin', '07/09/2018 21:08');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_recebimentos`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `id` int(6) NOT NULL,
  `nome` varchar(56) NOT NULL,
  `usuario` varchar(25) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `acessoTotal` tinyint(1) DEFAULT '0',
  `dataCadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id`, `nome`, `usuario`, `senha`, `acessoTotal`, `dataCadastro`) VALUES
(1, 'CVA', 'cva', '3d7c76317dc02619cbf97464f0541e8d', 1, '2018-09-09 01:06:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_clientes`
--
ALTER TABLE `tb_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_recebimentos`
--
ALTER TABLE `tb_recebimentos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_clientes`
--
ALTER TABLE `tb_clientes`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tb_recebimentos`
--
ALTER TABLE `tb_recebimentos`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
