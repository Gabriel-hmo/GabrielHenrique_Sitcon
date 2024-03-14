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

insert into pacientes (id, nome, dataNasc, CPF, status) values (1,'Augusto Fernandes','2000-08-10', '210.298.293-09', 'ativo');
insert into pacientes (id, nome, dataNasc, CPF, status) values (2,'Maria Silva Oliveira','1999-03-21', '210.298.293-09', 'ativo');
insert into pacientes (id, nome, dataNasc, CPF, status) values (3,'Alfonse Smikchuz','2002-10-02', '210.298.293-09', 'ativo');
insert into pacientes (id, nome, dataNasc, CPF, status) values (4,'Nagela Perreira','1997-05-16', '210.298.293-09', 'ativo');
insert into pacientes (id, nome, dataNasc, CPF, status) values (6,'João Paulo Ferreira','1995-06-26', '210.298.293-09', 'inativo');
insert into pacientes (id, nome, dataNasc, CPF, status) values (5,'Gustavo Hernanes','2001-07-10', '210.298.293-09', 'ativo');
insert into pacientes (id, nome, dataNasc, CPF, status) values (9,'Zira Silva','2003-02-14', '210.298.293-09', 'ativo');
insert into pacientes (id, nome, dataNasc, CPF, status) values (8,'Helena Marques','2000-01-11', '210.298.293-09', 'ativo');
insert into pacientes (id, nome, dataNasc, CPF, status) values (7,'Julio Costa Martins','1980-11-23', '210.298.293-09', 'ativo');
insert into pacientes (id, nome, dataNasc, CPF, status) values (10,'João Bicalho','1993-03-12', '210.298.293-09', 'inativo');
insert into pacientes (id, nome, dataNasc, CPF, status) values (12,'Carolina Rosa Silva','2001-12-24', '210.298.293-09', 'ativo');
insert into pacientes (id, nome, dataNasc, CPF, status) values (11,'Paulina Araujo','2002-08-10', '210.298.293-09', 'ativo');

insert into profissional (id, nome, status) values (1,'Orlando Nobrega', 'ativo');
insert into profissional (id, nome, status) values (2,'Rafaela Tenorio', 'ativo');
insert into profissional (id, nome, status) values (3,'João Paulo Nobrega', 'ativo');

insert into tipoSolicitacao (id, descricao, status) values (1,'Consulta', 'ativo');
insert into tipoSolicitacao (id, descricao, status) values (2,'Exames Laboratoriais', 'ativo');

insert into procedimentos (id, descricao, tipo_id, status) values (1,'Consulta Pediátrica ', 1, 'ativo');
insert into procedimentos (id, descricao, tipo_id, status) values (2,'Consulta Clínico Geral', 1, 'ativo');
insert into procedimentos (id, descricao, tipo_id, status) values (3,'Hemograma', 2, 'ativo');
insert into procedimentos (id, descricao, tipo_id, status) values (4,'Glicemia', 2, 'ativo');
insert into procedimentos (id, descricao, tipo_id, status) values (5,'Colesterol', 2, 'ativo');
insert into procedimentos (id, descricao, tipo_id, status) values (6,'Triglicerídeos', 2, 'ativo');


insert into profissionalAtende (id, procedimento_id, profissional_id, status) values (1, 1, 2, 'ativo');
insert into profissionalAtende (id, procedimento_id, profissional_id, status) values (2, 2, 2, 'ativo');
insert into profissionalAtende (id, procedimento_id, profissional_id, status) values (3, 2, 3, 'ativo');
insert into profissionalAtende (id, procedimento_id, profissional_id, status) values (4, 1, 3, 'inativo');
insert into profissionalAtende (id, procedimento_id, profissional_id, status) values (5, 3, 1, 'ativo');
insert into profissionalAtende (id, procedimento_id, profissional_id, status) values (6, 4, 1, 'ativo');
insert into profissionalAtende (id, procedimento_id, profissional_id, status) values (7, 5, 1, 'ativo');
insert into profissionalAtende (id, procedimento_id, profissional_id, status) values (8, 6, 1, 'ativo');
```
