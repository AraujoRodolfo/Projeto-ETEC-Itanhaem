-- MySQL Script generated by MySQL Workbench
-- dom 16 jun 2019 18:39:22 -03
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema etecitan_dev
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema etecitan_dev
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `etecitan_dev` DEFAULT CHARACTER SET utf8 ;
USE `etecitan_dev` ;

-- -----------------------------------------------------
-- Table `etecitan_dev`.`curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etecitan_dev`.`curso` (
  `id_curso` INT NOT NULL AUTO_INCREMENT,
  `id_coordenador` INT NOT NULL,
  `nm_curso` VARCHAR(45) NOT NULL,
  `ds_curso` TINYTEXT NULL,
  `tipo_curso` ENUM('modular', 'integrado') NOT NULL,
  `ds_status` ENUM('ativo', 'inativo') NOT NULL DEFAULT 'inativo',
  `ds_perguntas_respostas` TEXT NULL,
  PRIMARY KEY (`id_curso`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etecitan_dev`.`turma`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etecitan_dev`.`turma` (
  `id_turma` INT NOT NULL AUTO_INCREMENT,
  `id_curso` INT NOT NULL,
  `ano_turma` DATE NOT NULL,
  `semestre` ENUM('1', '2') NOT NULL,
  `ds_status` ENUM('ativo', 'inativo') NOT NULL DEFAULT 'inativo',
  PRIMARY KEY (`id_turma`),
  INDEX `fk_turma_curso1_idx` (`id_curso` ASC),
  CONSTRAINT `fk_turma_curso1`
    FOREIGN KEY (`id_curso`)
    REFERENCES `etecitan_dev`.`curso` (`id_curso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etecitan_dev`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etecitan_dev`.`usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `id_turma` INT NULL,
  `nm_usuario` VARCHAR(45) NOT NULL,
  `nm_email` VARCHAR(45) NOT NULL,
  `cd_senha` VARCHAR(45) NOT NULL,
  `dt_nascimento` DATE NOT NULL,
  `nm_img_perfil` VARCHAR(45) NULL,
  `ic_status` ENUM('ativo', 'inativo') NOT NULL DEFAULT 'inativo',
  `ds_social` TINYTEXT NULL,
  `hr_atendimento` TINYTEXT NULL,
  `cd_recuperacao_senha` VARCHAR(45) NULL,
  `dt_criacao_conta` DATETIME NOT NULL,
  `dt_atualizacao_conta` DATETIME NULL,
  `dt_ultimo_acesso` DATETIME NULL,
  `ip` VARCHAR(45) NULL,
  PRIMARY KEY (`id_usuario`),
  INDEX `fk_usuario_turma1_idx` (`id_turma` ASC),
  CONSTRAINT `fk_usuario_turma1`
    FOREIGN KEY (`id_turma`)
    REFERENCES `etecitan_dev`.`turma` (`id_turma`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etecitan_dev`.`grupo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etecitan_dev`.`grupo` (
  `id_grupo` INT NOT NULL AUTO_INCREMENT,
  `nm_grupo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_grupo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etecitan_dev`.`usuario_grupo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etecitan_dev`.`usuario_grupo` (
  `id_usuario_grupo` INT NOT NULL AUTO_INCREMENT,
  `id_usuario` INT NOT NULL,
  `id_grupo` INT NOT NULL,
  PRIMARY KEY (`id_usuario_grupo`),
  INDEX `fk_usuario_grupo_usuario_idx` (`id_usuario` ASC),
  INDEX `fk_usuario_grupo_grupo1_idx` (`id_grupo` ASC),
  CONSTRAINT `fk_usuario_grupo_usuario`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `etecitan_dev`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_grupo_grupo1`
    FOREIGN KEY (`id_grupo`)
    REFERENCES `etecitan_dev`.`grupo` (`id_grupo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etecitan_dev`.`disciplina`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etecitan_dev`.`disciplina` (
  `id_disciplina` INT NOT NULL AUTO_INCREMENT,
  `id_turma` INT NOT NULL,
  `id_prof1` INT NOT NULL,
  `id_prof2` INT NULL,
  `nm_disciplina` VARCHAR(45) NOT NULL,
  `ds_disciplina` TINYTEXT NULL,
  `ds_status` ENUM('ativo', 'inativo') NOT NULL DEFAULT 'inativo',
  PRIMARY KEY (`id_disciplina`),
  INDEX `fk_disciplina_turma1_idx` (`id_turma` ASC),
  INDEX `fk_disciplina_usuario1_idx` (`id_prof1` ASC),
  INDEX `fk_disciplina_usuario2_idx` (`id_prof2` ASC),
  CONSTRAINT `fk_disciplina_turma1`
    FOREIGN KEY (`id_turma`)
    REFERENCES `etecitan_dev`.`turma` (`id_turma`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_disciplina_usuario1`
    FOREIGN KEY (`id_prof1`)
    REFERENCES `etecitan_dev`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_disciplina_usuario2`
    FOREIGN KEY (`id_prof2`)
    REFERENCES `etecitan_dev`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etecitan_dev`.`projeto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etecitan_dev`.`projeto` (
  `id_projeto` INT NOT NULL AUTO_INCREMENT,
  `id_curso` INT NOT NULL,
  `nm_projeto` VARCHAR(55) NOT NULL,
  `ds_projeto` VARCHAR(45) NULL,
  `ic_disponivel` ENUM('sim', 'nao') NOT NULL DEFAULT 'nao',
  `nm_arquivo` VARCHAR(45) NULL,
  PRIMARY KEY (`id_projeto`),
  INDEX `fk_acervo_curso1_idx` (`id_curso` ASC),
  CONSTRAINT `fk_acervo_curso1`
    FOREIGN KEY (`id_curso`)
    REFERENCES `etecitan_dev`.`curso` (`id_curso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etecitan_dev`.`usuario_acervo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etecitan_dev`.`usuario_acervo` (
  `id_usuario_acervo` INT NOT NULL AUTO_INCREMENT,
  `id_usuario` INT NOT NULL,
  `id_acervo` INT NOT NULL,
  `tipo` ENUM('autor', 'mentor') NOT NULL,
  PRIMARY KEY (`id_usuario_acervo`),
  INDEX `fk_autor_usuario1_idx` (`id_usuario` ASC),
  INDEX `fk_autor_acervo1_idx` (`id_acervo` ASC),
  CONSTRAINT `fk_autor_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `etecitan_dev`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_autor_acervo1`
    FOREIGN KEY (`id_acervo`)
    REFERENCES `etecitan_dev`.`projeto` (`id_projeto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etecitan_dev`.`post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etecitan_dev`.`post` (
  `id_post` INT NOT NULL AUTO_INCREMENT,
  `id_update_post` INT NULL,
  `id_usuario` INT NOT NULL,
  `nm_post` VARCHAR(45) NOT NULL,
  `ds_post` TEXT NOT NULL,
  `dt_post` DATETIME NOT NULL,
  `ic_status` ENUM('ativo', 'inativo') NOT NULL DEFAULT 'inativo',
  `ds_tipo` ENUM('noticia', 'evento') NOT NULL,
  `programado` DATETIME NULL,
  PRIMARY KEY (`id_post`),
  INDEX `fk_post_usuario1_idx` (`id_usuario` ASC),
  INDEX `fk_post_post1_idx` (`id_update_post` ASC),
  CONSTRAINT `fk_post_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `etecitan_dev`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_post_post1`
    FOREIGN KEY (`id_update_post`)
    REFERENCES `etecitan_dev`.`post` (`id_post`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etecitan_dev`.`anexo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etecitan_dev`.`anexo` (
  `id_anexo` INT NOT NULL AUTO_INCREMENT,
  `id_post` INT NOT NULL,
  `nm_anexo` VARCHAR(45) NOT NULL,
  `ds_anexo` TINYTEXT NULL,
  PRIMARY KEY (`id_anexo`),
  INDEX `fk_anexo_post1_idx` (`id_post` ASC),
  CONSTRAINT `fk_anexo_post1`
    FOREIGN KEY (`id_post`)
    REFERENCES `etecitan_dev`.`post` (`id_post`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etecitan_dev`.`contato`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etecitan_dev`.`contato` (
  `id_contato` INT NOT NULL AUTO_INCREMENT,
  `nm_contato` VARCHAR(45) NOT NULL,
  `nm_email` VARCHAR(45) NOT NULL,
  `dt_envio` DATETIME NOT NULL,
  `nm_titulo` VARCHAR(45) NOT NULL,
  `ds_mensagem` TINYTEXT NULL,
  `ic_status` ENUM('respondido', 'em espera') NOT NULL DEFAULT 'em espera',
  PRIMARY KEY (`id_contato`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etecitan_dev`.`utilidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etecitan_dev`.`utilidade` (
  `id_utilidade` INT NOT NULL AUTO_INCREMENT,
  `nm_utilidade` VARCHAR(45) NOT NULL,
  `ds_utilidade` VARCHAR(45) NULL,
  `link_utilidade` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_utilidade`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etecitan_dev`.`tipo_requerimento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etecitan_dev`.`tipo_requerimento` (
  `id_tipo_requerimento` INT NOT NULL AUTO_INCREMENT,
  `nm_tipo_requerimento` VARCHAR(45) NOT NULL,
  `qt_dias_espera` INT(2) NOT NULL,
  PRIMARY KEY (`id_tipo_requerimento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etecitan_dev`.`requerimento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etecitan_dev`.`requerimento` (
  `id_requerimento` INT NOT NULL AUTO_INCREMENT,
  `id_tipo_requerimento` INT NOT NULL,
  `id_usuario` INT NOT NULL,
  `ic_status` ENUM('fechado', 'aberto') NOT NULL,
  `nm_anexo` VARCHAR(45) NOT NULL,
  `nm_anexo_resposta` VARCHAR(45) NOT NULL,
  `dt_requerimento` DATETIME NOT NULL,
  `cd_protocolo` VARCHAR(45) NOT NULL,
  `ds_requerimento` TINYTEXT NULL,
  PRIMARY KEY (`id_requerimento`),
  INDEX `fk_requerimento_tipo_requerimento1_idx` (`id_tipo_requerimento` ASC),
  INDEX `fk_requerimento_usuario1_idx` (`id_usuario` ASC),
  CONSTRAINT `fk_requerimento_tipo_requerimento1`
    FOREIGN KEY (`id_tipo_requerimento`)
    REFERENCES `etecitan_dev`.`tipo_requerimento` (`id_tipo_requerimento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_requerimento_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `etecitan_dev`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etecitan_dev`.`escola`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etecitan_dev`.`escola` (
  `id_escola` INT NOT NULL AUTO_INCREMENT,
  `nm_conteudo` VARCHAR(45) NOT NULL,
  `conteudo` LONGTEXT NOT NULL,
  `ic_status` ENUM('ativo', 'inativo') NOT NULL DEFAULT 'inativo',
  `dt_atualizacao` DATE NOT NULL,
  PRIMARY KEY (`id_escola`))
ENGINE = InnoDB;

ALTER TABLE `curso` ADD 
	CONSTRAINT `fk_curso_usuario1` 
	FOREIGN KEY (`id_coordenador`) 
	REFERENCES `etecitan_dev`.`usuario` (`id_usuario`)
	ON DELETE NO ACTION
    ON UPDATE NO ACTION;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
