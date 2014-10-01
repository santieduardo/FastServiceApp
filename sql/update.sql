SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE TABLE IF NOT EXISTS `pedidos` (
  `idPedidos` INT(30) NOT NULL AUTO_INCREMENT,
  `usuario` INT(15) NOT NULL,
  `total` DECIMAL(10,2) NOT NULL,
  `ctime` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` TINYINT(1) NOT NULL,
  PRIMARY KEY (`idPedidos`),
  INDEX `fk_pedidos_usuarios1_idx` (`usuario` ASC),
  CONSTRAINT `fk_pedidos_usuarios1`
    FOREIGN KEY (`usuario`)
    REFERENCES `usuarios` (`idUsuario`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `pedidos_produtos` (
  `produto` INT(10) NOT NULL,
  `pedido` INT(30) NOT NULL,
  `quantidade` INT(4) NOT NULL,
  PRIMARY KEY (`produto`, `pedido`),
  INDEX `fk_produtos_has_pedidos_pedidos1_idx` (`pedido` ASC),
  INDEX `fk_produtos_has_pedidos_produtos1_idx` (`produto` ASC),
  CONSTRAINT `fk_produtos_has_pedidos_produtos1`
    FOREIGN KEY (`produto`)
    REFERENCES `produtos` (`idProduto`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_produtos_has_pedidos_pedidos1`
    FOREIGN KEY (`pedido`)
    REFERENCES `pedidos` (`idPedidos`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
