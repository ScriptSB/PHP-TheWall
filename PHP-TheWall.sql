-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema thewall
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema thewall
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `thewall` DEFAULT CHARACTER SET utf8 ;
USE `thewall` ;

-- -----------------------------------------------------
-- Table `thewall`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `thewall`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NULL,
  `first_name` VARCHAR(45) NULL,
  `last_name` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `salt` VARCHAR(22) NULL,
  `email` VARCHAR(255) NULL,
  `created_on` DATETIME NULL,
  `updated_on` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `thewall`.`messages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `thewall`.`messages` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `message` LONGTEXT NULL,
  `created_on` DATETIME NULL,
  `updated_on` DATETIME NULL,
  `users_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_messages_users_idx` (`users_id` ASC),
  CONSTRAINT `fk_messages_users`
    FOREIGN KEY (`users_id`)
    REFERENCES `thewall`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `thewall`.`comments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `thewall`.`comments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `comment` VARCHAR(255) NULL,
  `created_on` DATETIME NULL,
  `updated_on` DATETIME NULL,
  `messages_id` INT NOT NULL,
  `users_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comments_messages1_idx` (`messages_id` ASC),
  INDEX `fk_comments_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_comments_messages1`
    FOREIGN KEY (`messages_id`)
    REFERENCES `thewall`.`messages` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `thewall`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
