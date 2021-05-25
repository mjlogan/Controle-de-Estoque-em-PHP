-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 10/12/2019 às 18:36
-- Versão do servidor: 5.7.28-0ubuntu0.18.04.4
-- Versão do PHP: 7.2.24-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `controlestoque`
--
CREATE DATABASE IF NOT EXISTS `vendaschocolatier` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `vendaschocolatier`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL,
  `NomeCliente` varchar(100) NOT NULL,
  `EmailCliente` varchar(100) NOT NULL,
  `cpfCliente` text NOT NULL,
  `statusCliente` int(1) NOT NULL,
  `Usuario_idUsuario` int(11) NOT NULL,
  `dataRegCliente` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`idCliente`, `NomeCliente`, `EmailCliente`, `cpfCliente`, `statusCliente`, `Usuario_idUsuario`, `dataRegCliente`) VALUES
(1, 'Thiago Ribeiro', 'thiago@teste.com', '88888888820', 1, 2, '2019-02-21 21:28:57');

-- --------------------------------------------------------

--
-- Estrutura para tabela `fabricante`
--

DROP TABLE IF EXISTS `fabricante`;
CREATE TABLE `fabricante` (
  `idFabricante` int(11) NOT NULL,
  `NomeFabricante` varchar(75) NOT NULL,
  `CNPJFabricante` varchar(75) NOT NULL,
  `EmailFabricante` varchar(75) NOT NULL,
  `EnderecoFabricante` varchar(75) NOT NULL,
  `TelefoneFabricante` varchar(75) NOT NULL,
  `Public` int(1) NOT NULL,
  `Ativo` int(1) NOT NULL,
  `Usuario_idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `fabricante`
--

INSERT INTO `fabricante` (`idFabricante`, `NomeFabricante`, `CNPJFabricante`, `EmailFabricante`, `EnderecoFabricante`, `TelefoneFabricante`, `Public`, `Ativo`, `Usuario_idUser`) VALUES
(1, 'Andrea Balista Chocolatier', '29096361000165', 'ibm@ibm.com', 'Av. José Pancetti, 300', '11 99641-5997', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens`
--

DROP TABLE IF EXISTS `itens`;
CREATE TABLE `itens` (
  `idItens` int(11) NOT NULL,
  `Image` varchar(250) NOT NULL,
  `QuantItens` decimal(10,0) NOT NULL,
  `QuantItensVend` decimal(10,0) NOT NULL,
  `ValCompItens` decimal(10,2) NOT NULL,
  `ValVendItens` decimal(10,2) NOT NULL,
  `DataCompraItens` date NOT NULL,
  `DataVenci_Itens` date DEFAULT NULL,
  `ItensAtivo` tinyint(4) NOT NULL,
  `ItensPublic` int(1) NOT NULL,
  `Produto_CodRefProduto` int(11) NOT NULL,
  `Fabricante_idFabricante` int(11) NOT NULL,
  `Usuario_idUser` int(11) NOT NULL,
  `DataRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `itens`
--

INSERT INTO `itens` (`idItens`, `Image`, `QuantItens`, `QuantItensVend`, `ValCompItens`, `ValVendItens`, `DataCompraItens`, `DataVenci_Itens`, `ItensAtivo`, `ItensPublic`, `Produto_CodRefProduto`, `Fabricante_idFabricante`, `Usuario_idUser`, `DataRegistro`) VALUES
(11, '', '500', '372', '1700.00', '2100.00', '2018-10-27', '2018-10-31', 1, 1, 1, 1, 2, '2018-10-27 20:38:39');
-- (12, '', '200', '166', '3.00', '9.00', '2018-10-27', '2018-10-31', 1, 1, 3, 1, 2, '2018-10-27 20:43:12'),
-- (13, '', '100', '32', '4.00', '9.50', '2019-09-17', '2019-09-17', 1, 1, 3, 1, 2, '2019-09-17 21:07:25'),
-- (14, '', '200', '8', '2100.00', '3900.00', '2019-09-17', '2019-09-17', 1, 1, 4, 7, 2, '2019-09-17 21:21:40'),
-- (15, '', '1000', '11', '0.30', '1.00', '2019-09-17', '2020-09-17', 1, 1, 6, 4, 2, '2019-09-17 21:29:33');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE `produtos` (
  `CodRefProduto` int(11) NOT NULL,
  `NomeProduto` varchar(75) NOT NULL,
  `Ativo` int(1) NOT NULL,
  `PublicProduto` int(1) NOT NULL,
  `Usuario_idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`CodRefProduto`, `NomeProduto`, `Ativo`, `PublicProduto`, `Usuario_idUser`) VALUES
(1, 'Crispinho ao leite 150g', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `representante`
--

DROP TABLE IF EXISTS `representante`;
CREATE TABLE `representante` (
  `idRepresentante` int(11) NOT NULL,
  `NomeRepresentante` varchar(75) NOT NULL,
  `TelefoneRepresentante` varchar(20) NOT NULL,
  `EmailRepresentante` varchar(45) NOT NULL,
  `repAtivo` int(1) NOT NULL,
  `repPublic` int(1) NOT NULL,
  `Fabricante_idFabricante` int(11) NOT NULL,
  `Usuario_idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `representante`
--

INSERT INTO `representante` (`idRepresentante`, `NomeRepresentante`, `TelefoneRepresentante`, `EmailRepresentante`, `repAtivo`, `repPublic`, `Fabricante_idFabricante`, `Usuario_idUser`) VALUES
(1, 'Francisco Algusto', '11 9999-9999', 'franciscoalgusto@ibm.com', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `idUser` int(11) NOT NULL,
  `Username` varchar(75) NOT NULL,
  `Email` varchar(75) NOT NULL,
  `Password` varchar(75) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `Dataregistro` date NOT NULL,
  `Permissao` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`idUser`, `Username`, `Email`, `Password`, `imagem`, `Dataregistro`, `Permissao`) VALUES
(1, 'administrador', 'andreroc@gmail.com', 'M3str3Supr3m0#', 'dist/img/fabriciopaixao.jpg', '2017-04-03', 1),
(2, 'sibalista', 'simone.balista@skdainformacao.com.br', 'M0n3Adm#', 'dist/img/fabriciopaixao.jpg', '2017-04-03', 1),
(3, 'abalista', 'contato@andreabalista.com.br', '4ndr344dm1n!', 'dist/img/fabriciopaixao.jpg', '2017-04-03', 1),
(4, 'vendedora', 'vendedora@ajour.com.br', 'V3nd4sJ4', 'dist/img/fabriciopaixao.jpg', '2017-04-03', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas`
--

DROP TABLE IF EXISTS `vendas`;
CREATE TABLE `vendas` (
  `idvendas` int(11) NOT NULL,
  `quantitens` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `iditem` int(11) NOT NULL,
  `cart` varchar(255) NOT NULL,
  `cliente_idCliente` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `datareg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `vendas`
--

INSERT INTO `vendas` (`idvendas`, `quantitens`, `valor`, `iditem`, `cart`, `cliente_idCliente`, `idusuario`, `datareg`) VALUES
(1, 10, '11000.00', 12, '', 1, 2, '2019-02-21 21:27:12');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`);

--
-- Índices de tabela `fabricante`
--
ALTER TABLE `fabricante`
  ADD PRIMARY KEY (`idFabricante`),
  ADD KEY `fk_Fabricante_Usuario1_idx` (`Usuario_idUser`);

--
-- Índices de tabela `itens`
--
ALTER TABLE `itens`
  ADD PRIMARY KEY (`idItens`),
  ADD KEY `fk_Itens_Produto1_idx` (`Produto_CodRefProduto`),
  ADD KEY `fk_Itens_Fabricante1_idx` (`Fabricante_idFabricante`),
  ADD KEY `fk_Itens_Usuario1_idx` (`Usuario_idUser`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`CodRefProduto`),
  ADD KEY `fk_Produto_Usuario_idx` (`Usuario_idUser`);

--
-- Índices de tabela `representante`
--
ALTER TABLE `representante`
  ADD PRIMARY KEY (`idRepresentante`),
  ADD KEY `fk_Representante_Fabricante1_idx` (`Fabricante_idFabricante`),
  ADD KEY `fk_Representante_Usuario1_idx` (`Usuario_idUser`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUser`);

--
-- Índices de tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`idvendas`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `fabricante`
--
ALTER TABLE `fabricante`
  MODIFY `idFabricante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `itens`
--
ALTER TABLE `itens`
  MODIFY `idItens` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `CodRefProduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `representante`
--
ALTER TABLE `representante`
  MODIFY `idRepresentante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `idvendas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `fabricante`
--
ALTER TABLE `fabricante`
  ADD CONSTRAINT `fk_Fabricante_Usuario1` FOREIGN KEY (`Usuario_idUser`) REFERENCES `usuario` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `itens`
--
ALTER TABLE `itens`
  ADD CONSTRAINT `fk_Itens_Fabricante1` FOREIGN KEY (`Fabricante_idFabricante`) REFERENCES `fabricante` (`idFabricante`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Itens_Produto1` FOREIGN KEY (`Produto_CodRefProduto`) REFERENCES `produtos` (`CodRefProduto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Itens_Usuario1` FOREIGN KEY (`Usuario_idUser`) REFERENCES `usuario` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_Produto_Usuario` FOREIGN KEY (`Usuario_idUser`) REFERENCES `usuario` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `representante`
--
ALTER TABLE `representante`
  ADD CONSTRAINT `fk_Representante_Fabricante1` FOREIGN KEY (`Fabricante_idFabricante`) REFERENCES `fabricante` (`idFabricante`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Representante_Usuario1` FOREIGN KEY (`Usuario_idUser`) REFERENCES `usuario` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
