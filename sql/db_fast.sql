-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 08-Set-2014 às 22:03
-- Versão do servidor: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_fast`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
`idCategoria` int(10) NOT NULL,
  `nome` varchar(60) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `nome`) VALUES
(1, 'Bebidas'),
(2, 'Salgados');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE IF NOT EXISTS `produtos` (
  `idProduto` int(15) NOT NULL,
  `categoria` int(10) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`idProduto`, `categoria`, `nome`, `preco`, `status`) VALUES
(1, 1, 'Coca Cola', '5.12', 1),
(2, 1, 'Ice Tea Leão Fuze Pêssego', '4.50', 1),
(3, 1, 'Ice Tea Leão Fuze Limão', '4.50', 0),
(4, 2, 'Empanado de Frango', '3.00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
 ADD PRIMARY KEY (`idCategoria`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
 ADD PRIMARY KEY (`idProduto`), ADD KEY `fk_produtos_categorias_idx` (`categoria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
MODIFY `idCategoria` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
ADD CONSTRAINT `fk_produtos_categorias` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`idCategoria`) ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
