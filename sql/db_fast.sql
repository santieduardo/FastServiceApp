/*
Navicat MySQL Data Transfer

Source Server         : _localhost
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : db_fast

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2014-10-01 20:33:00
*/

SET FOREIGN_KEY_CHECKS=0;

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
-- Table structure for `pedidos`
-- ----------------------------
DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE `pedidos` (
  `idPedido` int(30) NOT NULL AUTO_INCREMENT,
  `usuario` int(15) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `ctime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`idPedido`),
  KEY `fk_pedidos_usuarios1_idx` (`usuario`),
  CONSTRAINT `fk_pedidos_usuarios1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pedidos
-- ----------------------------
INSERT INTO `pedidos` VALUES ('1', '2', '1.50', '2014-09-30 22:24:59', '2');
INSERT INTO `pedidos` VALUES ('2', '2', '16.55', '2014-09-30 22:42:03', '2');

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
  CONSTRAINT `fk_produtos_has_pedidos_pedidos1` FOREIGN KEY (`pedido`) REFERENCES `pedidos` (`idPedido`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_produtos_has_pedidos_produtos1` FOREIGN KEY (`produto`) REFERENCES `produtos` (`idProduto`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pedidos_produtos
-- ----------------------------
INSERT INTO `pedidos_produtos` VALUES ('4', '1', '10');
INSERT INTO `pedidos_produtos` VALUES ('4', '2', '1');
INSERT INTO `pedidos_produtos` VALUES ('5', '2', '4');
INSERT INTO `pedidos_produtos` VALUES ('6', '2', '3');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of produtos
-- ----------------------------
INSERT INTO `produtos` VALUES ('1', '1', 'Empada de Frango', '3.50', '1', 'salgado.jpg');
INSERT INTO `produtos` VALUES ('2', '1', 'Bolinho de Carne', '2.75', '0', 'default.jpg');
INSERT INTO `produtos` VALUES ('3', '2', 'Bombom Amor Carioca', '1.25', '1', 'default.jpg');
INSERT INTO `produtos` VALUES ('4', '2', 'Balas Sortidas', '0.15', '1', 'default.jpg');
INSERT INTO `produtos` VALUES ('5', '3', 'Coca-Cola Lata', '2.00', '1', 'cocacola.jpg');
INSERT INTO `produtos` VALUES ('6', '3', 'Suco Del Valle Pêssego', '2.80', '1', 'default.jpg');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES ('2', 'Henrique Rieger', 'Schmidt', 'henrique@conjunto.com.br', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1412126678');
