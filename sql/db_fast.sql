-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 03-Out-2014 às 13:51
-- Versão do servidor: 5.5.39
-- PHP Version: 5.4.31

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
  `nome` varchar(60) NOT NULL,
  `label` varchar(30) NOT NULL DEFAULT 'default'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `nome`, `label`) VALUES
(1, 'Salgados', 'info'),
(2, 'Doces', 'success'),
(3, 'Bebidas', 'primary');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
`idPedido` int(30) NOT NULL,
  `usuario` int(15) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `ctime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`idPedido`, `usuario`, `total`, `ctime`, `status`) VALUES
(1, 3, '1.75', '2014-10-03 11:31:17', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos_produtos`
--

CREATE TABLE IF NOT EXISTS `pedidos_produtos` (
  `produto` int(10) NOT NULL,
  `pedido` int(30) NOT NULL,
  `quantidade` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedidos_produtos`
--

INSERT INTO `pedidos_produtos` (`produto`, `pedido`, `quantidade`) VALUES
(10, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE IF NOT EXISTS `produtos` (
`idProduto` int(10) NOT NULL,
  `categoria` int(10) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `arquivo` varchar(45) NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`idProduto`, `categoria`, `nome`, `preco`, `status`, `arquivo`) VALUES
(1, 1, 'Empada de Frango', '3.50', 1, 'empadafrango.jpg'),
(2, 1, 'Bolinho de Carne', '2.75', 0, 'default.jpg'),
(3, 2, 'Sonho de Valsa', '1.25', 1, 'sonhodevalsa.jpg'),
(4, 2, 'Balas Sortidas', '0.15', 1, 'balassortidas.jpg'),
(5, 3, 'Coca-Cola Lata', '2.00', 1, 'cocacola.jpg'),
(6, 3, 'Suco Del Valle Pêssego', '2.80', 1, 'delvallepessego.jpg'),
(7, 1, 'Cachorrinho de Salsicha', '3.50', 1, 'cachorrinhosalsicha.jpg'),
(8, 2, 'Serenata de Amor', '1.25', 1, 'serenata.jpg'),
(9, 1, 'Croissant', '2.75', 1, 'croissant.jpg'),
(10, 3, 'Café Preto', '1.75', 1, 'cafepreto.jpg'),
(11, 3, 'Cappuccino', '2.50', 1, 'cappuccino.jpg'),
(12, 3, 'Chás Sabores', '1.75', 1, 'chas.jpg'),
(13, 2, 'Snickers', '2.00', 1, 'snickers.jpg'),
(14, 3, 'Água Mineral com Gás', '2.00', 1, 'aguamineral.jpg'),
(15, 3, 'Água Mineral sem Gás', '2.00', 1, 'aguamineral.jpg'),
(16, 1, 'Pão de Queijo', '2.25', 1, 'paodequeijo.jpg'),
(17, 3, 'Energético Burn', '6.50', 1, 'energeticoburn.jpg'),
(18, 3, 'Copo Suco de Laranja', '3.50', 1, 'coposucolaranja.jpg'),
(19, 1, 'Sanduíche Natural', '3.75', 1, 'sanduichenatural.jpg'),
(20, 1, 'Torrada', '4.25', 1, 'torrada.jpg'),
(21, 1, 'Pastel Assado Sabores', '3.50', 1, 'pastelassado.jpg'),
(22, 1, 'Pastel Frito Sabores', '3.50', 1, 'pastelfrito.jpg'),
(23, 2, 'Bolinho Inglês Sabores', '3.75', 1, 'boloingles.jpg'),
(24, 1, 'Esfirra Sabores', '3.50', 1, 'esfirra.jpg'),
(25, 1, 'Hamburguer', '3.50', 1, 'hamburguer.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sessions`
--

INSERT INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('9074da0c3ed27cdc67227e7ce8cec14c', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36', 1412276488, 'a:2:{s:9:"user_data";s:0:"";s:8:"carrinho";O:8:"stdClass":2:{s:8:"produtos";a:0:{}s:5:"total";d:0;}}'),
('e3eeffacde3100933b6ce2a5183cf98c', '::1', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36', 1412336839, 'a:3:{s:9:"user_data";s:0:"";s:8:"carrinho";O:8:"stdClass":2:{s:8:"produtos";a:0:{}s:5:"total";d:0;}s:7:"usuario";O:8:"stdClass":3:{s:9:"idUsuario";s:1:"3";s:5:"email";s:13:"edu@santi.com";s:4:"nome";s:7:"Eduardo";}}');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`idUsuario` int(15) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `sobrenome` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `senha` char(40) NOT NULL,
  `ctime` int(16) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nome`, `sobrenome`, `email`, `senha`, `ctime`) VALUES
(2, 'Henrique Rieger', 'Schmidt', 'henrique@conjunto.com.br', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1412126678),
(3, 'Eduardo', 'Santi', 'edu@santi.com', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 1412335861);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
 ADD PRIMARY KEY (`idCategoria`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
 ADD PRIMARY KEY (`idPedido`), ADD KEY `fk_pedidos_usuarios1_idx` (`usuario`);

--
-- Indexes for table `pedidos_produtos`
--
ALTER TABLE `pedidos_produtos`
 ADD PRIMARY KEY (`produto`,`pedido`), ADD KEY `fk_produtos_has_pedidos_pedidos1_idx` (`pedido`), ADD KEY `fk_produtos_has_pedidos_produtos1_idx` (`produto`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
 ADD PRIMARY KEY (`idProduto`), ADD KEY `fk_produtos_categorias_idx` (`categoria`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
 ADD PRIMARY KEY (`session_id`), ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
MODIFY `idCategoria` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
MODIFY `idPedido` int(30) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
MODIFY `idProduto` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `idUsuario` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `pedidos`
--
ALTER TABLE `pedidos`
ADD CONSTRAINT `fk_pedidos_usuarios1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pedidos_produtos`
--
ALTER TABLE `pedidos_produtos`
ADD CONSTRAINT `fk_produtos_has_pedidos_produtos1` FOREIGN KEY (`produto`) REFERENCES `produtos` (`idProduto`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_produtos_has_pedidos_pedidos1` FOREIGN KEY (`pedido`) REFERENCES `pedidos` (`idPedido`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
ADD CONSTRAINT `fk_produtos_categorias` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`idCategoria`) ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
