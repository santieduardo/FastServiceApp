/*
Navicat MySQL Data Transfer

Source Server         : _localhost
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : db_fast

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2014-09-13 18:17:26
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
INSERT INTO `usuarios` VALUES ('1', 'Fulano', 'Silva', 'teste@teste.com.br', 'teste1', '0');
