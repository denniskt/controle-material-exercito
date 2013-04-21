-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2013 at 02:17 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `siscmex`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `inserirUsuario`(
in cd int,
in nome varchar(30),
in setor int)
begin

insert into USUARIO (cd_identidade, nm_usuario, cd_setor)
values (cd, nome, setor);

end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `documento_entrada`
--

CREATE TABLE IF NOT EXISTS `documento_entrada` (
  `cd_nota_fiscal` int(11) NOT NULL,
  `cd_cnpj` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`cd_nota_fiscal`),
  KEY `DOCENTRADA_FORNECEDOR_FK` (`cd_cnpj`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `entrada_material`
--

CREATE TABLE IF NOT EXISTS `entrada_material` (
  `cd_material` int(11) NOT NULL,
  `qt_material` int(11) DEFAULT NULL,
  `cd_nota_fiscal` int(11) NOT NULL,
  PRIMARY KEY (`cd_material`,`cd_nota_fiscal`),
  KEY `ENTRADA_DOCUMENTO_ENTRADA_FK` (`cd_nota_fiscal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fornecedor`
--

CREATE TABLE IF NOT EXISTS `fornecedor` (
  `cd_cnpj` varchar(30) NOT NULL,
  `nm_razao_social` varchar(30) DEFAULT NULL,
  `nm_endereco` varchar(50) NOT NULL,
  `nm_telefone` varchar(20) DEFAULT NULL,
  `nm_email` varchar(70) DEFAULT NULL,
  `nm_ramo_atividade` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`cd_cnpj`),
  UNIQUE KEY `FORNECEDOR__UN` (`nm_email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE IF NOT EXISTS `material` (
  `cd_material` int(11) NOT NULL,
  `nm_material` varchar(30) DEFAULT NULL,
  `nm_descricao` varchar(50) DEFAULT NULL,
  `qt_material` int(11) DEFAULT NULL,
  `nm_tipo` varchar(30) DEFAULT NULL,
  `sg_unidade` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`cd_material`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `saida_material`
--

CREATE TABLE IF NOT EXISTS `saida_material` (
  `cd_solicitacao` int(11) NOT NULL,
  `cd_material` int(11) NOT NULL,
  `qt_material` int(11) DEFAULT NULL,
  PRIMARY KEY (`cd_solicitacao`,`cd_material`),
  KEY `SAIDA_MATERIAL_FK` (`cd_material`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `setor`
--

CREATE TABLE IF NOT EXISTS `setor` (
  `cd_setor` int(11) NOT NULL,
  `nm_setor` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`cd_setor`),
  UNIQUE KEY `SETOR__UN` (`cd_setor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `solicitacao_material`
--

CREATE TABLE IF NOT EXISTS `solicitacao_material` (
  `cd_solicitacao` int(11) NOT NULL,
  `cd_setor` int(11) NOT NULL,
  PRIMARY KEY (`cd_solicitacao`),
  KEY `SOLICITACAO_SETOR_FK` (`cd_setor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `cd_identidade` int(11) NOT NULL,
  `nm_usuario` varchar(30) DEFAULT NULL,
  `nm_guerra` varchar(15) DEFAULT NULL,
  `nm_senha` varchar(8) DEFAULT NULL,
  `nm_acesso` varchar(30) DEFAULT NULL,
  `cd_setor` int(11) DEFAULT NULL,
  PRIMARY KEY (`cd_identidade`),
  KEY `USUARIO_SETOR_FK` (`cd_setor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`cd_identidade`, `nm_usuario`, `nm_guerra`, `nm_senha`, `nm_acesso`, `cd_setor`) VALUES
(123, 'administrador_teste', 'adm', 'testeADM', '0', NULL),
(124, 'almoxarife_teste', '', 'testeALM', '1', NULL),
(125, 'solicitante_teste', NULL, 'testeSOL', '3', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `documento_entrada`
--
ALTER TABLE `documento_entrada`
  ADD CONSTRAINT `DOCENTRADA_FORNECEDOR_FK` FOREIGN KEY (`cd_cnpj`) REFERENCES `fornecedor` (`cd_cnpj`);

--
-- Constraints for table `entrada_material`
--
ALTER TABLE `entrada_material`
  ADD CONSTRAINT `ENTRADA_MATERIAL_FK` FOREIGN KEY (`cd_material`) REFERENCES `material` (`cd_material`),
  ADD CONSTRAINT `ENTRADA_DOCUMENTO_ENTRADA_FK` FOREIGN KEY (`cd_nota_fiscal`) REFERENCES `documento_entrada` (`cd_nota_fiscal`);

--
-- Constraints for table `saida_material`
--
ALTER TABLE `saida_material`
  ADD CONSTRAINT `SAIDA_SOLICITACAO_MATERIAL_FK` FOREIGN KEY (`cd_solicitacao`) REFERENCES `solicitacao_material` (`cd_solicitacao`),
  ADD CONSTRAINT `SAIDA_MATERIAL_FK` FOREIGN KEY (`cd_material`) REFERENCES `material` (`cd_material`);

--
-- Constraints for table `solicitacao_material`
--
ALTER TABLE `solicitacao_material`
  ADD CONSTRAINT `SOLICITACAO_SETOR_FK` FOREIGN KEY (`cd_setor`) REFERENCES `setor` (`cd_setor`);

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `USUARIO_SETOR_FK` FOREIGN KEY (`cd_setor`) REFERENCES `setor` (`cd_setor`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
