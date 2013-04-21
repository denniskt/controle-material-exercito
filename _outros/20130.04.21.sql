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
/*!40101 SET NAMES latin1 */;

--
-- Banco de Dados: `siscmex`
--
CREATE DATABASE `siscmex` DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci;
USE `siscmex`;

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `alterarUsuario`(IN `id` INT(11), IN `nome` VARCHAR(30), IN `guerra` VARCHAR(30), IN `senha` VARCHAR(30), IN `nivel` INT, IN `setor` VARCHAR(30))
    NO SQL
BEGIN

UPDATE usuario
SET cd_identidade = id, nm_usuario=nome, nm_guerra=guerra, nm_senha=senha, nm_acesso=nivel, cd_setor=setor
WHERE  cd_identidade = id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `inserirUsuario`(IN `id` INT, IN `nome` VARCHAR(30), IN `guerra` VARCHAR(30), IN `senha` VARCHAR(30), IN `nivel` VARCHAR(30), IN `setor` INT)
begin

INSERT INTO usuario (cd_identidade, nm_usuario, nm_guerra, nm_senha, nm_acesso, cd_setor)
values (id, nome, guerra, senha, nivel, setor);

end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `documento_entrada`
--

CREATE TABLE IF NOT EXISTS `documento_entrada` (
  `cd_nota_fiscal` int(11) NOT NULL,
  `cd_cnpj` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`cd_nota_fiscal`),
  KEY `DOCENTRADA_FORNECEDOR_FK` (`cd_cnpj`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `entrada_material`
--

CREATE TABLE IF NOT EXISTS `entrada_material` (
  `cd_material` int(11) NOT NULL,
  `qt_material` int(11) DEFAULT NULL,
  `cd_nota_fiscal` int(11) NOT NULL,
  PRIMARY KEY (`cd_material`,`cd_nota_fiscal`),
  KEY `ENTRADA_DOCUMENTO_ENTRADA_FK` (`cd_nota_fiscal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE IF NOT EXISTS `fornecedor` (
  `cd_cnpj` varchar(30) CHARACTER SET latin1 NOT NULL,
  `nm_razao_social` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `nm_endereco` varchar(50) CHARACTER SET latin1 NOT NULL,
  `nm_telefone` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `nm_email` varchar(70) CHARACTER SET latin1 DEFAULT NULL,
  `nm_ramo_atividade` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`cd_cnpj`),
  UNIQUE KEY `FORNECEDOR__UN` (`nm_email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `material`
--

CREATE TABLE IF NOT EXISTS `material` (
  `cd_material` int(11) NOT NULL,
  `nm_material` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `nm_descricao` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `qt_material` int(11) DEFAULT NULL,
  `nm_tipo` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `sg_unidade` varchar(5) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`cd_material`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `saida_material`
--

CREATE TABLE IF NOT EXISTS `saida_material` (
  `cd_solicitacao` int(11) NOT NULL,
  `cd_material` int(11) NOT NULL,
  `qt_material` int(11) DEFAULT NULL,
  PRIMARY KEY (`cd_solicitacao`,`cd_material`),
  KEY `SAIDA_MATERIAL_FK` (`cd_material`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `setor`
--

CREATE TABLE IF NOT EXISTS `setor` (
  `cd_setor` int(11) NOT NULL,
  `nm_setor` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`cd_setor`),
  UNIQUE KEY `SETOR__UN` (`cd_setor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `setor`
--

INSERT INTO `setor` (`cd_setor`, `nm_setor`) VALUES
(0, 'Financeiro'),
(1, 'Diretoria'),
(2, 'Financeiro'),
(3, 'Almoxarifado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitacao_material`
--

CREATE TABLE IF NOT EXISTS `solicitacao_material` (
  `cd_solicitacao` int(11) NOT NULL,
  `cd_setor` int(11) NOT NULL,
  PRIMARY KEY (`cd_solicitacao`),
  KEY `SOLICITACAO_SETOR_FK` (`cd_setor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `cd_identidade` int(11) NOT NULL,
  `nm_usuario` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `nm_guerra` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `nm_senha` varchar(8) CHARACTER SET latin1 DEFAULT NULL,
  `nm_acesso` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `cd_setor` int(11) DEFAULT NULL,
  PRIMARY KEY (`cd_identidade`),
  KEY `USUARIO_SETOR_FK` (`cd_setor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`cd_identidade`, `nm_usuario`, `nm_guerra`, `nm_senha`, `nm_acesso`, `cd_setor`) VALUES
(0, 'DEnnis EU', 'hjg', 'asd', '1', 1),
(123, 'administrador_teste', 'adm', 'testeADM', '0', 1),
(124, 'almoxarife_teste', 'Alm', 'testeALM', '1', 3),
(125, 'solicitante_teste', 'Adsa', 'testeSOL', '3', 0),
(5435, 'regcearg', 'cergcaerg', '123', '1', 1),
(23132, 'dennis', 'ASasd', '1534', '2', 3),
(123123, 'DEnnis', 'Kenji', '3213', '1', 1),
(346345, 'wefwef', 'wef', '2123', '1', 1),
(3235243, 'Dennis', 'EU', '123', '1', 3),
(6546456, 'Denis', 'Eu', 'fgdg', '2', 1),
(543534534, 'Dennis', 'EuEu', '123124', '1', 1),
(2147483647, 'Dennis', 'Dennis', '348237', '1', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) CHARACTER SET latin1 NOT NULL,
  `username` varchar(50) CHARACTER SET latin1 NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `username`, `email`, `created`, `modified`) VALUES
(1, 'Dennis', 'Kenji', 'denniskt@gmail.com', '2013-04-20 22:20:33', '2013-04-20 22:20:33'),
(2, 'Colgate', 'Plax Editado', 'colgate@uol.com.br', '2013-04-20 22:21:26', '2013-04-20 22:21:37'),
(3, 'Mario', 'Silva', 'mario@globo.com', '2013-04-20 22:22:35', '2013-04-20 22:22:35'),
(4, 'Vevo', 'Video', 'vevo@vevo.com', '2013-04-20 22:23:27', '2013-04-21 01:30:24');

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `documento_entrada`
--
ALTER TABLE `documento_entrada`
  ADD CONSTRAINT `DOCENTRADA_FORNECEDOR_FK` FOREIGN KEY (`cd_cnpj`) REFERENCES `fornecedor` (`cd_cnpj`);

--
-- Restrições para a tabela `entrada_material`
--
ALTER TABLE `entrada_material`
  ADD CONSTRAINT `ENTRADA_DOCUMENTO_ENTRADA_FK` FOREIGN KEY (`cd_nota_fiscal`) REFERENCES `documento_entrada` (`cd_nota_fiscal`),
  ADD CONSTRAINT `ENTRADA_MATERIAL_FK` FOREIGN KEY (`cd_material`) REFERENCES `material` (`cd_material`);

--
-- Restrições para a tabela `saida_material`
--
ALTER TABLE `saida_material`
  ADD CONSTRAINT `SAIDA_MATERIAL_FK` FOREIGN KEY (`cd_material`) REFERENCES `material` (`cd_material`),
  ADD CONSTRAINT `SAIDA_SOLICITACAO_MATERIAL_FK` FOREIGN KEY (`cd_solicitacao`) REFERENCES `solicitacao_material` (`cd_solicitacao`);

--
-- Restrições para a tabela `solicitacao_material`
--
ALTER TABLE `solicitacao_material`
  ADD CONSTRAINT `SOLICITACAO_SETOR_FK` FOREIGN KEY (`cd_setor`) REFERENCES `setor` (`cd_setor`);

--
-- Restrições para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `USUARIO_SETOR_FK` FOREIGN KEY (`cd_setor`) REFERENCES `setor` (`cd_setor`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
