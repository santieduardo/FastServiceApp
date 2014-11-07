/*
Navicat MySQL Data Transfer

Source Server         : _localhost
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : db_fast

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2014-11-07 19:30:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admins`
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `senha` char(40) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `ltime` varchar(45) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario_UNIQUE` (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admins
-- ----------------------------

-- ----------------------------
-- Table structure for `admin_flags`
-- ----------------------------
DROP TABLE IF EXISTS `admin_flags`;
CREATE TABLE `admin_flags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `flag` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `flag_UNIQUE` (`flag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_flags
-- ----------------------------

-- ----------------------------
-- Table structure for `admin_permissoes`
-- ----------------------------
DROP TABLE IF EXISTS `admin_permissoes`;
CREATE TABLE `admin_permissoes` (
  `admin` int(11) NOT NULL,
  `flag` int(11) NOT NULL,
  PRIMARY KEY (`admin`,`flag`),
  KEY `fk_admins_has_admin_flags_admin_flags1_idx` (`flag`),
  KEY `fk_admins_has_admin_flags_admins1_idx` (`admin`),
  CONSTRAINT `fk_admins_has_admin_flags_admins1` FOREIGN KEY (`admin`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_admins_has_admin_flags_admin_flags1` FOREIGN KEY (`flag`) REFERENCES `admin_flags` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_permissoes
-- ----------------------------

-- ----------------------------
-- Table structure for `categorias`
-- ----------------------------
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `idCategoria` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `label` varchar(30) NOT NULL DEFAULT 'default',
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categorias
-- ----------------------------
INSERT INTO `categorias` VALUES ('1', 'Salgados', 'info');
INSERT INTO `categorias` VALUES ('2', 'Doces', 'success');
INSERT INTO `categorias` VALUES ('3', 'Bebidas', 'primary');

-- ----------------------------
-- Table structure for `conexoes`
-- ----------------------------
DROP TABLE IF EXISTS `conexoes`;
CREATE TABLE `conexoes` (
  `id` varchar(60) NOT NULL,
  `tipo` int(2) NOT NULL,
  `token` text NOT NULL,
  `usuario` int(15) NOT NULL,
  PRIMARY KEY (`id`,`tipo`),
  KEY `fk_conexoes_usuarios1_idx` (`usuario`),
  CONSTRAINT `fk_conexoes_usuarios1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of conexoes
-- ----------------------------

-- ----------------------------
-- Table structure for `pedidos`
-- ----------------------------
DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE `pedidos` (
  `idPedido` int(30) NOT NULL AUTO_INCREMENT,
  `usuario` int(15) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `ctime` int(16) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`idPedido`),
  KEY `fk_pedidos_usuarios1_idx` (`usuario`),
  CONSTRAINT `fk_pedidos_usuarios1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pedidos
-- ----------------------------

-- ----------------------------
-- Table structure for `pedidos_produtos`
-- ----------------------------
DROP TABLE IF EXISTS `pedidos_produtos`;
CREATE TABLE `pedidos_produtos` (
  `produto` int(10) NOT NULL,
  `pedido` int(30) NOT NULL,
  `quantidade` int(4) NOT NULL,
  PRIMARY KEY (`produto`,`pedido`),
  KEY `fk_produtos_has_pedidos_pedidos1_idx` (`pedido`),
  KEY `fk_produtos_has_pedidos_produtos1_idx` (`produto`),
  CONSTRAINT `fk_produtos_has_pedidos_produtos1` FOREIGN KEY (`produto`) REFERENCES `produtos` (`idProduto`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_produtos_has_pedidos_pedidos1` FOREIGN KEY (`pedido`) REFERENCES `pedidos` (`idPedido`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pedidos_produtos
-- ----------------------------

-- ----------------------------
-- Table structure for `produtos`
-- ----------------------------
DROP TABLE IF EXISTS `produtos`;
CREATE TABLE `produtos` (
  `idProduto` int(10) NOT NULL AUTO_INCREMENT,
  `categoria` int(10) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `arquivo` varchar(45) NOT NULL DEFAULT 'default.jpg',
  PRIMARY KEY (`idProduto`),
  KEY `fk_produtos_categorias_idx` (`categoria`),
  CONSTRAINT `fk_produtos_categorias` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`idCategoria`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of produtos
-- ----------------------------
INSERT INTO `produtos` VALUES ('1', '1', 'Empada de Frango', '3.50', '1', 'empadafrango.jpg');
INSERT INTO `produtos` VALUES ('2', '1', 'Bolinho de Carne', '2.75', '0', 'default.jpg');
INSERT INTO `produtos` VALUES ('3', '2', 'Sonho de Valsa', '1.25', '1', 'sonhodevalsa.jpg');
INSERT INTO `produtos` VALUES ('4', '2', 'Balas Sortidas', '0.15', '1', 'balassortidas.jpg');
INSERT INTO `produtos` VALUES ('5', '3', 'Coca-Cola Lata', '2.00', '1', 'cocacola.jpg');
INSERT INTO `produtos` VALUES ('6', '3', 'Suco Del Valle Pêssego', '2.80', '1', 'delvallepessego.jpg');
INSERT INTO `produtos` VALUES ('7', '1', 'Cachorrinho de Salsicha', '3.50', '1', 'cachorrinhosalsicha.jpg');
INSERT INTO `produtos` VALUES ('8', '2', 'Serenata de Amor', '1.25', '1', 'serenata.jpg');
INSERT INTO `produtos` VALUES ('9', '1', 'Croissant', '2.75', '1', 'croissant.jpg');
INSERT INTO `produtos` VALUES ('10', '3', 'Café Preto', '1.75', '1', 'cafepreto.jpg');
INSERT INTO `produtos` VALUES ('11', '3', 'Cappuccino', '2.50', '1', 'cappuccino.jpg');
INSERT INTO `produtos` VALUES ('12', '3', 'Chás Sabores', '1.75', '1', 'chas.jpg');
INSERT INTO `produtos` VALUES ('13', '2', 'Snickers', '2.00', '1', 'snickers.jpg');
INSERT INTO `produtos` VALUES ('14', '3', 'Água Mineral com Gás', '2.00', '1', 'aguamineral.jpg');
INSERT INTO `produtos` VALUES ('15', '3', 'Água Mineral sem Gás', '2.00', '1', 'aguamineral.jpg');
INSERT INTO `produtos` VALUES ('16', '1', 'Pão de Queijo', '2.25', '1', 'paodequeijo.jpg');
INSERT INTO `produtos` VALUES ('17', '3', 'Energético Burn', '6.50', '1', 'energeticoburn.jpg');
INSERT INTO `produtos` VALUES ('18', '3', 'Copo Suco de Laranja', '3.50', '1', 'coposucolaranja.jpg');
INSERT INTO `produtos` VALUES ('19', '1', 'Sanduíche Natural', '3.75', '1', 'sanduichenatural.jpg');
INSERT INTO `produtos` VALUES ('20', '1', 'Torrada', '4.25', '1', 'torrada.jpg');
INSERT INTO `produtos` VALUES ('21', '1', 'Pastel Assado Sabores', '3.50', '1', 'pastelassado.jpg');
INSERT INTO `produtos` VALUES ('22', '1', 'Pastel Frito Sabores', '3.50', '1', 'pastelfrito.jpg');
INSERT INTO `produtos` VALUES ('23', '2', 'Bolinho Inglês Sabores', '3.75', '1', 'boloingles.jpg');
INSERT INTO `produtos` VALUES ('24', '1', 'Esfirra Sabores', '3.50', '1', 'esfirra.jpg');
INSERT INTO `produtos` VALUES ('25', '1', 'Hamburguer', '3.50', '1', 'hamburguer.jpg');

-- ----------------------------
-- Table structure for `sessions`
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sessions
-- ----------------------------

-- ----------------------------
-- Table structure for `usuarios`
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `idUsuario` int(15) NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) NOT NULL,
  `sobrenome` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `senha` char(40) NOT NULL,
  `ctime` int(16) NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
