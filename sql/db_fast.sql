-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 09, 2014 at 10:00 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

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
-- Table structure for table `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `idCategoria` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `label` varchar(30) NOT NULL DEFAULT 'default',
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `nome`, `label`) VALUES
(1, 'Salgados', 'info'),
(2, 'Doces', 'success'),
(3, 'Bebidas', 'primary');

-- --------------------------------------------------------

--
-- Table structure for table `produtos`
--

CREATE TABLE IF NOT EXISTS `produtos` (
  `idProduto` int(10) NOT NULL AUTO_INCREMENT,
  `categoria` int(10) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `arquivo` varchar(45) NOT NULL DEFAULT 'default.jpg',
  PRIMARY KEY (`idProduto`),
  KEY `fk_produtos_categorias_idx` (`categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `produtos`
--

INSERT INTO `produtos` (`idProduto`, `categoria`, `nome`, `preco`, `status`, `arquivo`) VALUES
(1, 1, 'Empada de Frango', '3.50', 1, 'salgado.jpg'),
(2, 1, 'Bolinho de Carne', '2.75', 0, 'default.jpg'),
(3, 2, 'Bombom Amor Carioca', '1.25', 1, 'default.jpg'),
(4, 2, 'Balas Sortidas', '0.15', 1, 'default.jpg'),
(5, 3, 'Coca-Cola Lata', '2.00', 1, 'cocacola.jpg'),
(6, 3, 'Suco Del Valle Pêssego', '2.80', 1, 'default.jpg');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_produtos_categorias` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`idCategoria`) ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;