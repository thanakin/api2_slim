CREATE TABLE IF NOT EXISTS `SlimProdutos`.`Categorias` (
`id` INT NOT NULL AUTO_INCREMENT ,
`nome` VARCHAR(100) NULL ,
PRIMARY KEY (`id`) )
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `SlimProdutos`.`Produtos` (
`id` INT NOT NULL AUTO_INCREMENT ,
`nome` VARCHAR(100) NULL ,
`preco` DECIMAL(10,2) NULL ,
`dataInclusao` DATE NULL ,
`idCategoria` INT NOT NULL ,
PRIMARY KEY (`id`) ,
INDEX `fk_Produtos_Categorias_idx` (`idCategoria` ASC) ,
CONSTRAINT `fk_Produtos_Categorias`
FOREIGN KEY (`idCategoria` )
REFERENCES `SlimProdutos`.`Categorias` (`id` )
ON DELETE NO ACTION
ON UPDATE NO ACTION)
ENGINE = InnoDB;