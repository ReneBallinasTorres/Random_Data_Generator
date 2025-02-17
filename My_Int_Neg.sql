-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema My_Int_Neg
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema My_Int_Neg
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `My_Int_Neg` DEFAULT CHARACTER SET utf8 ;
USE `My_Int_Neg` ;

-- -----------------------------------------------------
-- Table `My_Int_Neg`.`entidad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `My_Int_Neg`.`entidad` (
  `id_entidad` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id_entidad`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `My_Int_Neg`.`beneficiario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `My_Int_Neg`.`beneficiario` (
  `id_beneficiario` INT NOT NULL AUTO_INCREMENT,
  `curp` VARCHAR(18) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido_p` VARCHAR(45) NOT NULL,
  `apellido_m` VARCHAR(45) NOT NULL,
  `genero` VARCHAR(1) NOT NULL,
  `edad` INT NOT NULL,
  `tipo_vivienda` VARCHAR(45) NOT NULL,
  `estado_civil` VARCHAR(45) NOT NULL,
  `tarjeta_bancaria` VARCHAR(45) NOT NULL,
  `id_entidad` INT NOT NULL,
  PRIMARY KEY (`id_beneficiario`),
  INDEX `fk_beneficiario_entidad1_idx` (`id_entidad` ASC),
  CONSTRAINT `fk_beneficiario_entidad1`
    FOREIGN KEY (`id_entidad`)
    REFERENCES `My_Int_Neg`.`entidad` (`id_entidad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `My_Int_Neg`.`institucion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `My_Int_Neg`.`institucion` (
  `id_institucio` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `nivel` VARCHAR(25) NOT NULL,
  `id_entidad` INT NOT NULL,
  PRIMARY KEY (`id_institucio`),
  INDEX `fk_institucion_entidad_idx` (`id_entidad` ASC),
  CONSTRAINT `fk_institucion_entidad`
    FOREIGN KEY (`id_entidad`)
    REFERENCES `My_Int_Neg`.`entidad` (`id_entidad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `My_Int_Neg`.`equipo_computo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `My_Int_Neg`.`equipo_computo` (
  `id_equipoComputo` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(45) NOT NULL,
  `marca` VARCHAR(45) NOT NULL,
  `modelo` VARCHAR(45) NOT NULL,
  `estado` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_equipoComputo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `My_Int_Neg`.`solicitud`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `My_Int_Neg`.`solicitud` (
  `id_solicitud` INT NOT NULL AUTO_INCREMENT,
  `fecha_solicitud` DATE NOT NULL,
  `carrera` VARCHAR(45) NOT NULL,
  `promedio` VARCHAR(45) NOT NULL,
  `id_beneficiario` INT NOT NULL,
  `id_institucio` INT NOT NULL,
  PRIMARY KEY (`id_solicitud`),
  INDEX `fk_solicitud_beneficiario1_idx` (`id_beneficiario` ASC),
  INDEX `fk_solicitud_institucion1_idx` (`id_institucio` ASC),
  CONSTRAINT `fk_solicitud_beneficiario1`
    FOREIGN KEY (`id_beneficiario`)
    REFERENCES `My_Int_Neg`.`beneficiario` (`id_beneficiario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_solicitud_institucion1`
    FOREIGN KEY (`id_institucio`)
    REFERENCES `My_Int_Neg`.`institucion` (`id_institucio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `My_Int_Neg`.`prestamo_equipo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `My_Int_Neg`.`prestamo_equipo` (
  `id_prestamoEquipo` INT NOT NULL AUTO_INCREMENT,
  `fecha_prestamo` DATE NOT NULL,
  `fecha_devolucion` DATE NOT NULL,
  `estado` VARCHAR(15) NOT NULL,
  `id_solicitud` INT NOT NULL,
  `id_equipoComputo` INT NOT NULL,
  PRIMARY KEY (`id_prestamoEquipo`),
  INDEX `fk_prestamo_equipo_solicitud1_idx` (`id_solicitud` ASC),
  INDEX `fk_prestamo_equipo_equipo_computo1_idx` (`id_equipoComputo` ASC),
  CONSTRAINT `fk_prestamo_equipo_solicitud1`
    FOREIGN KEY (`id_solicitud`)
    REFERENCES `My_Int_Neg`.`solicitud` (`id_solicitud`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_prestamo_equipo_equipo_computo1`
    FOREIGN KEY (`id_equipoComputo`)
    REFERENCES `My_Int_Neg`.`equipo_computo` (`id_equipoComputo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `My_Int_Neg`.`reporte`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `My_Int_Neg`.`reporte` (
  `id_reporte` INT NOT NULL AUTO_INCREMENT,
  `fecha_reporte` DATE NOT NULL,
  `observacion` VARCHAR(45) NOT NULL,
  `estado` VARCHAR(45) NOT NULL,
  `id_prestamoEquipo` INT NOT NULL,
  PRIMARY KEY (`id_reporte`),
  INDEX `fk_reporte_prestamo_equipo1_idx` (`id_prestamoEquipo` ASC),
  CONSTRAINT `fk_reporte_prestamo_equipo1`
    FOREIGN KEY (`id_prestamoEquipo`)
    REFERENCES `My_Int_Neg`.`prestamo_equipo` (`id_prestamoEquipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
