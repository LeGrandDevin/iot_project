-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema u928306449_groupe_quatre
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema u928306449_groupe_quatre
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `u928306449_groupe_quatre` DEFAULT CHARACTER SET utf8 ;
USE `u928306449_groupe_quatre` ;

-- -----------------------------------------------------
-- Table `u928306449_groupe_quatre`.`credentials`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u928306449_groupe_quatre`.`credentials` (
  `idCredential` INT NOT NULL AUTO_INCREMENT,
  `password` VARCHAR(45) NOT NULL,
  `identifiant` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idCredential`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u928306449_groupe_quatre`.`captorData`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u928306449_groupe_quatre`.`captorData` (
  `idcaptorData` INT NOT NULL AUTO_INCREMENT,
  `humidity` FLOAT NOT NULL,
  `temperature` FLOAT NOT NULL,
  `date` DATETIME NOT NULL,
  PRIMARY KEY (`idcaptorData`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
