```SQL
CREATE TABLE IF NOT EXISTS `mydb`.`pacientes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `dataNasc` DATE NOT NULL,
  `CPF` VARCHAR(14) NOT NULL,
  `status` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `mydb`.`profissional` (
  `id` INT NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  `status` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `mydb`.`tipoSolicitacao` (
  `id` INT NOT NULL,
  `descricao` VARCHAR(45) NULL,
  `status` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `mydb`.`procedimentos` (
  `id` INT NOT NULL,
  `descricao` VARCHAR(45) NULL,
  `tipo_id` INT NOT NULL,
  `status` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_procedimentos_tipoSolicitacao_idx` (`tipo_id` ASC) VISIBLE,
  CONSTRAINT `fk_procedimentos_tipoSolicitacao`
    FOREIGN KEY (`tipo_id`)
    REFERENCES `mydb`.`tipoSolicitacao` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `mydb`.`profissionalAtende` (
  `id` INT NOT NULL,
  `status` VARCHAR(45) NULL,
  `procedimento_id` INT NOT NULL,
  `profissional_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_profissionalAtende_profissional1_idx` (`profissional_id` ASC) VISIBLE,
  INDEX `fk_profissionalAtende_procedimentos1_idx` (`procedimento_id` ASC) VISIBLE,
  CONSTRAINT `fk_profissionalAtende_profissional1`
    FOREIGN KEY (`profissional_id`)
    REFERENCES `mydb`.`profissional` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_profissionalAtende_procedimentos1`
    FOREIGN KEY (`procedimento_id`)
    REFERENCES `mydb`.`procedimentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `mydb`.`solicitacao` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `data` DATETIME NULL,
  `pacientes_id` INT NOT NULL,
  `procedimentos_id` INT NOT NULL,
  `profissional_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_solicitacao_pacientes1_idx` (`pacientes_id` ASC) VISIBLE,
  INDEX `fk_solicitacao_procedimentos1_idx` (`procedimentos_id` ASC) VISIBLE,
  INDEX `fk_solicitacao_profissional1_idx` (`profissional_id` ASC) VISIBLE,
  CONSTRAINT `fk_solicitacao_pacientes1`
    FOREIGN KEY (`pacientes_id`)
    REFERENCES `mydb`.`pacientes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_solicitacao_procedimentos1`
    FOREIGN KEY (`procedimentos_id`)
    REFERENCES `mydb`.`procedimentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_solicitacao_profissional1`
    FOREIGN KEY (`profissional_id`)
    REFERENCES `mydb`.`profissional` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
```
