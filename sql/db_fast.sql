-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 14-Nov-2014 às 13:23
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
-- Estrutura da tabela `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
`id` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `senha` char(40) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `ltime` varchar(45) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin_flags`
--

CREATE TABLE IF NOT EXISTS `admin_flags` (
`id` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `flag` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin_permissoes`
--

CREATE TABLE IF NOT EXISTS `admin_permissoes` (
  `admin` int(11) NOT NULL,
  `flag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Estrutura da tabela `conexoes`
--

CREATE TABLE IF NOT EXISTS `conexoes` (
  `id` varchar(60) NOT NULL,
  `tipo` int(2) NOT NULL,
  `token` text NOT NULL,
  `usuario` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
`idPedido` int(30) NOT NULL,
  `usuario` int(15) DEFAULT '0',
  `total` decimal(10,2) NOT NULL,
  `ctime` int(16) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`idPedido`, `usuario`, `total`, `ctime`, `status`) VALUES
(8, 0, '3.90', 1415967675, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos_produtos`
--

CREATE TABLE IF NOT EXISTS `pedidos_produtos` (
  `produto` int(10) NOT NULL,
  `pedido` int(30) NOT NULL,
  `quantidade` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nome`, `sobrenome`, `email`, `senha`, `ctime`) VALUES
(0, 'Sistema', '', 'localhos@localhost', 'nopassword', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `usuario_UNIQUE` (`usuario`);

--
-- Indexes for table `admin_flags`
--
ALTER TABLE `admin_flags`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `flag_UNIQUE` (`flag`);

--
-- Indexes for table `admin_permissoes`
--
ALTER TABLE `admin_permissoes`
 ADD PRIMARY KEY (`admin`,`flag`), ADD KEY `fk_admins_has_admin_flags_admin_flags1_idx` (`flag`), ADD KEY `fk_admins_has_admin_flags_admins1_idx` (`admin`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
 ADD PRIMARY KEY (`idCategoria`);

--
-- Indexes for table `conexoes`
--
ALTER TABLE `conexoes`
 ADD PRIMARY KEY (`id`,`tipo`), ADD KEY `fk_conexoes_usuarios1_idx` (`usuario`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `admin_flags`
--
ALTER TABLE `admin_flags`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
MODIFY `idCategoria` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
MODIFY `idPedido` int(30) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
MODIFY `idProduto` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `idUsuario` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `admin_permissoes`
--
ALTER TABLE `admin_permissoes`
ADD CONSTRAINT `fk_admins_has_admin_flags_admin_flags1` FOREIGN KEY (`flag`) REFERENCES `admin_flags` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_admins_has_admin_flags_admins1` FOREIGN KEY (`admin`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `conexoes`
--
ALTER TABLE `conexoes`
ADD CONSTRAINT `fk_conexoes_usuarios1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pedidos`
--
ALTER TABLE `pedidos`
ADD CONSTRAINT `fk_pedidos_usuarios1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pedidos_produtos`
--
ALTER TABLE `pedidos_produtos`
ADD CONSTRAINT `fk_produtos_has_pedidos_pedidos1` FOREIGN KEY (`pedido`) REFERENCES `pedidos` (`idPedido`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_produtos_has_pedidos_produtos1` FOREIGN KEY (`produto`) REFERENCES `produtos` (`idProduto`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
ADD CONSTRAINT `fk_produtos_categorias` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`idCategoria`) ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
