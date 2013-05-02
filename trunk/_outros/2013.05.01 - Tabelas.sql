-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: 
-- Versão do Servidor: 5.5.27
-- Versão do PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `siscmex`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `entrada`
--

CREATE TABLE IF NOT EXISTS `entrada` (
  `cd_entrada` int(11) NOT NULL,
  `cd_nota_fiscal` int(11) DEFAULT NULL,
  `dt_emissao_nf` datetime DEFAULT NULL,
  `cd_cnpj` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`cd_entrada`),
  KEY `cd_cnpj` (`cd_cnpj`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque`
--

CREATE TABLE IF NOT EXISTS `estoque` (
  `cd_material` int(11) NOT NULL,
  `qt_material` int(11) DEFAULT NULL,
  PRIMARY KEY (`cd_material`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE IF NOT EXISTS `fornecedor` (
  `cd_cnpj` varchar(20) NOT NULL,
  `nm_razao_soc` varchar(30) NOT NULL,
  `nm_endereco` varchar(50) NOT NULL,
  `nm_telefone` varchar(20) NOT NULL,
  `nm_email` varchar(100) DEFAULT NULL,
  `nm_ramo_ativ` varchar(30) DEFAULT NULL,
  `cd_ativo_fornecedor` int(1) NOT NULL,
  PRIMARY KEY (`cd_cnpj`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `fornecedor`
--

INSERT INTO `fornecedor` (`cd_cnpj`, `nm_razao_soc`, `nm_endereco`, `nm_telefone`, `nm_email`, `nm_ramo_ativ`, `cd_ativo_fornecedor`) VALUES
('12435657356735', 'Silva e Silva', 'Rua Silva, 18', '1231-2323', 'silva@silvasilva.com', 'Material de Escritorio', 1),
('34534534534534', '345345', '34535345', '4534534534', '4534534534', 'asdasdas', 0),
('34534565478677868678', '234nfyn', 'nyjnt ty  cty c ty ct ct', '56775698797', 'fwef', '', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_entrada`
--

CREATE TABLE IF NOT EXISTS `item_entrada` (
  `cd_material` int(11) DEFAULT NULL,
  `cd_entrada` int(11) DEFAULT NULL,
  `dt_recebido` datetime DEFAULT NULL,
  `qt_recebido` int(11) DEFAULT NULL,
  KEY `cd_material` (`cd_material`),
  KEY `cd_entrada` (`cd_entrada`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_solicitacao`
--

CREATE TABLE IF NOT EXISTS `item_solicitacao` (
  `cd_material` int(11) DEFAULT NULL,
  `cd_solicitacao` int(11) DEFAULT NULL,
  `qt_solicitado` datetime DEFAULT NULL,
  `qt_aprovado` int(11) DEFAULT NULL,
  `dt_retirada` datetime DEFAULT NULL,
  KEY `cd_material` (`cd_material`),
  KEY `cd_solicitacao` (`cd_solicitacao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `material`
--

CREATE TABLE IF NOT EXISTS `material` (
  `cd_material` int(11) NOT NULL AUTO_INCREMENT,
  `nm_material` varchar(30) DEFAULT NULL,
  `nm_descricao` varchar(100) DEFAULT NULL,
  `sg_unidade_med` varchar(5) DEFAULT NULL,
  `sg_tipo_material` varchar(10) DEFAULT NULL,
  `cd_ativo_material` int(1) NOT NULL,
  PRIMARY KEY (`cd_material`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2147483647 ;

--
-- Extraindo dados da tabela `material`
--

INSERT INTO `material` (`cd_material`, `nm_material`, `nm_descricao`, `sg_unidade_med`, `sg_tipo_material`, `cd_ativo_material`) VALUES
(0, 'EWFWEF', 'WEFWEF', 'WEFWE', 'WEFWEF', 0),
(1, 'ergerger g', 'er gerg erg', 'e rg ', 'e gerg', 1),
(2, 'erg erg er', 'ge rgergasd', 'erg', 'arg e', 1),
(4, 'khjh', NULL, NULL, NULL, 0),
(2147483647, 'r egr e', 'e gerg', ' erg ', 'Tipo Edita', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `nivel_acesso`
--

CREATE TABLE IF NOT EXISTS `nivel_acesso` (
  `cd_acesso` int(1) NOT NULL,
  `nm_acesso` varchar(15) NOT NULL,
  PRIMARY KEY (`cd_acesso`),
  KEY `cd_acesso` (`cd_acesso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `nivel_acesso`
--

INSERT INTO `nivel_acesso` (`cd_acesso`, `nm_acesso`) VALUES
(0, 'Administrador'),
(1, 'Almoxarife'),
(2, 'Solicitante');

-- --------------------------------------------------------

--
-- Estrutura da tabela `setor`
--

CREATE TABLE IF NOT EXISTS `setor` (
  `sg_setor` varchar(5) NOT NULL,
  `nm_setor` varchar(30) NOT NULL,
  `cd_ativo_setor` int(1) NOT NULL,
  PRIMARY KEY (`sg_setor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `setor`
--

INSERT INTO `setor` (`sg_setor`, `nm_setor`, `cd_ativo_setor`) VALUES
('ABCDE', 'AAABC', 1),
('ACAS', '', 0),
('ALMOX', 'Almoxarifado2', 1),
('asdas', 'asdasdsad asdas da sd', 0),
('ASDFB', 'DGVVREVER', 1),
('DESAT', 'Desativado', 1),
('DIRET', 'Diretoria', 1),
('rtgrt', 'rtbrtbrtb', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitacao`
--

CREATE TABLE IF NOT EXISTS `solicitacao` (
  `cd_solicitacao` int(11) NOT NULL,
  `dt_solicitacao` datetime DEFAULT NULL,
  `ic_aprovacao` char(1) DEFAULT NULL,
  `ds_cancelamento` varchar(100) DEFAULT NULL,
  `cd_identidade` int(11) DEFAULT NULL,
  PRIMARY KEY (`cd_solicitacao`),
  KEY `cd_identidade` (`cd_identidade`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `cd_identidade` int(11) NOT NULL,
  `nm_usuario` varchar(30) NOT NULL,
  `nm_guerra` varchar(30) NOT NULL,
  `sg_setor` varchar(5) NOT NULL,
  `nm_senha` varchar(64) NOT NULL,
  `cd_acesso` int(1) DEFAULT NULL,
  `cd_ativo_usuario` int(1) NOT NULL,
  PRIMARY KEY (`cd_identidade`),
  KEY `sg_setor` (`sg_setor`),
  KEY `cd_acesso` (`cd_acesso`),
  KEY `cd_acesso_2` (`cd_acesso`),
  KEY `cd_acesso_3` (`cd_acesso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`cd_identidade`, `nm_usuario`, `nm_guerra`, `sg_setor`, `nm_senha`, `cd_acesso`, `cd_ativo_usuario`) VALUES
(0, 'Administrador', 'Administrador', 'DIRET', 'MA==', 0, 1),
(1, 'Almoxarife', 'Almoxarife', 'ALMOX', 'MQ==', 1, 1),
(2, 'Solicitante', 'Solicitante', 'DIRET', 'Mg==', 2, 1),
(4, 'Usuario Teste Inativo', 'Inativo', 'ALMOX', 'a87ff679a2f3e71d9181a67b7542122c', 2, 0),
(11, 'dedeergt', 'trht', 'DIRET', '11', 2, 0),
(41, 'Ebiehiui ui iuh iu hiu hi hiu ', 'hiuh i fie riur', 'ALMOX', 'YjI2MDkxZmZiNGM5MDFmYzg4MGMyMGM5ZjY0MGQ2OTA=', 1, 1),
(456, '456456', '456', 'asdas', '250cf8b51c773f3f8dc8b4be867a9a02', 0, 0),
(2222, '2222222222', '22222222', 'DESAT', '934b535800b1cba8f96a5d72f72f1611', 1, 0),
(2343, 'regreg', 'erg', 'DIRET', '234', 0, 0),
(8678, 'dedereg', 'dedede', 'ALMOX', '9ed6ce2a74bb40d489b896a3f42123bd', 0, 1),
(11111, '1111111111', '111111111', 'ALMOX', '96e79218965eb72c92a549dd5a330112', 0, 0),
(24234, 'dfg rg eger ', 'e rge ge g', 'ALMOX', '0e9212587d373ca58e9bada0c15e6fe4', 0, 1),
(24324, '', 'rth rht rth', 'DIRET', '33c0ee425e2c0efe834afc1aa1e33a4c', 0, 0),
(34234, 'verg er ger g', 'erge rg', 'DIRET', '847dc0f7420f7d9b30abccf8729bd028', 1, 1),
(123123, 'asda1wef', 'asd', 'ALMOX', '51888604cf507f0d151b78db9eed4e30', 0, 1),
(123321, 'Teste Div', 'div', 'ALMOX', 'b610295fea526d7c32a5ab82d74a9063', 0, 1),
(12435345, 'ger er geg', ' erger gerg', 'ALMOX', '8d509c28896865f8640f328f30f15721', 0, 1),
(32456456, 'ergergreg er g', 'ererge rge rg', 'DIRET', 'ffa61acbd53470895d6952e5419bcca8', 2, 1),
(56465456, '5645645', 'dytfyry', 'ALMOX', 'YXNkYXNk', 0, 0),
(75676786, 'tyjtyj', 'tyj', 'ALMOX', 'bdf96fb8c913d2cc3693dfec9f319774', 0, 1),
(86786786, '678678678', '678678', 'ALMOX', '9f7f8e3622cd9310e9ee096537f4c28f', 0, 1),
(2147483647, '9999999', '9999999', 'ALMOX', 'b706835de79a2b4e80506f582af3676a', 0, 1);

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `entrada`
--
ALTER TABLE `entrada`
  ADD CONSTRAINT `entrada_ibfk_1` FOREIGN KEY (`cd_cnpj`) REFERENCES `fornecedor` (`cd_cnpj`);

--
-- Restrições para a tabela `item_entrada`
--
ALTER TABLE `item_entrada`
  ADD CONSTRAINT `item_entrada_ibfk_1` FOREIGN KEY (`cd_material`) REFERENCES `material` (`cd_material`),
  ADD CONSTRAINT `item_entrada_ibfk_2` FOREIGN KEY (`cd_entrada`) REFERENCES `entrada` (`cd_entrada`);

--
-- Restrições para a tabela `item_solicitacao`
--
ALTER TABLE `item_solicitacao`
  ADD CONSTRAINT `item_solicitacao_ibfk_1` FOREIGN KEY (`cd_material`) REFERENCES `material` (`cd_material`),
  ADD CONSTRAINT `item_solicitacao_ibfk_2` FOREIGN KEY (`cd_solicitacao`) REFERENCES `solicitacao` (`cd_solicitacao`);

--
-- Restrições para a tabela `solicitacao`
--
ALTER TABLE `solicitacao`
  ADD CONSTRAINT `solicitacao_ibfk_1` FOREIGN KEY (`cd_identidade`) REFERENCES `usuario` (`cd_identidade`);

--
-- Restrições para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`sg_setor`) REFERENCES `setor` (`sg_setor`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`cd_acesso`) REFERENCES `nivel_acesso` (`cd_acesso`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
