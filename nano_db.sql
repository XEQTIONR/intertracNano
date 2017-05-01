SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema xeqtionr_nano_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `xeqtionr_nano_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `xeqtionr_nano_db` ;

-- -----------------------------------------------------
-- Table `xeqtionr_nano_db`.`TYRES`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `xeqtionr_nano_db`.`TYRES` ;

CREATE TABLE IF NOT EXISTS `xeqtionr_nano_db`.`TYRES` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tyre_brand` VARCHAR(15) NOT NULL DEFAULT 'INTERTRAC',
  `tyre_size` VARCHAR(15) NOT NULL,
  `tyre_pattern` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `xeqtionr_nano_db`.`HSCODES`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `xeqtionr_nano_db`.`HSCODES` ;

CREATE TABLE IF NOT EXISTS `xeqtionr_nano_db`.`HSCODES` (
  `id` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `xeqtionr_nano_db`.`TYRE_HSCODES`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `xeqtionr_nano_db`.`TYRE_HSCODES` ;

CREATE TABLE IF NOT EXISTS `xeqtionr_nano_db`.`TYRE_HSCODES` (
  `tyre_id` INT NOT NULL,
  `hscode` VARCHAR(20) NOT NULL,
  INDEX `fk_TYRE_idx` (`tyre_id` ASC),
  INDEX `fk_HSCODE_idx` (`hscode` ASC),
  CONSTRAINT `fk_TYREtyre`
    FOREIGN KEY (`tyre_id`)
    REFERENCES `xeqtionr_nano_db`.`TYRES` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_HSCODEhscode`
    FOREIGN KEY (`hscode`)
    REFERENCES `xeqtionr_nano_db`.`HSCODES` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `xeqtionr_nano_db`.`LCS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `xeqtionr_nano_db`.`LCS` ;

CREATE TABLE IF NOT EXISTS `xeqtionr_nano_db`.`LCS` (
  `id` VARCHAR(15) NOT NULL,
  `LC_dateissued` DATE NOT NULL,
  `LC_dateexpiry` DATE NOT NULL,
  `LC_applicant` VARCHAR(100) NOT NULL,
  `LC_beneficiary` VARCHAR(100) NOT NULL,
  `LC_currencycode` VARCHAR(5) NOT NULL DEFAULT 'USD',
  `LC_foreignamount` DECIMAL(10,2) NOT NULL,
  `LC_foreignexpense` DECIMAL(10,2) NOT NULL DEFAULT 0.0,
  `:LC_domesticexpense` DECIMAL(10,2) NOT NULL DEFAULT 0.0,
  `LC_exchangerate` DECIMAL(5,2) NOT NULL DEFAULT 1.0,
  `LC_portdepart` VARCHAR(30) NOT NULL DEFAULT 'ENTER PORT',
  `LC_portarrive` VARCHAR(30) NOT NULL DEFAULT 'ENTER PORT',
  `LC_invoice#` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `LC_invoice#_UNIQUE` (`LC_invoice#` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `xeqtionr_nano_db`.`PERFORMA_INVOICES`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `xeqtionr_nano_db`.`PERFORMA_INVOICES` ;

CREATE TABLE IF NOT EXISTS `xeqtionr_nano_db`.`PERFORMA_INVOICES` (
  `lc#` VARCHAR(15) NOT NULL,
  `tyre_id` INT NOT NULL,
  `qty` INT NOT NULL DEFAULT 1,
  `unit_price` DECIMAL(5,2) NOT NULL,
  PRIMARY KEY (`lc#`),
  INDEX `fk_TYRE_idx` (`tyre_id` ASC),
  CONSTRAINT `fk_LCperforma`
    FOREIGN KEY (`lc#`)
    REFERENCES `xeqtionr_nano_db`.`LCS` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_TYREperforma`
    FOREIGN KEY (`tyre_id`)
    REFERENCES `xeqtionr_nano_db`.`TYRES` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `xeqtionr_nano_db`.`CONSIGNMENTS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `xeqtionr_nano_db`.`CONSIGNMENTS` ;

CREATE TABLE IF NOT EXISTS `xeqtionr_nano_db`.`CONSIGNMENTS` (
  `id` VARCHAR(30) NOT NULL DEFAULT 'CONSIGNMENT ID / BOL#',
  `LC#` VARCHAR(15) NOT NULL,
  `c_val` DECIMAL(10,2) NOT NULL,
  `c_Tax` DECIMAL(10,2) NOT NULL DEFAULT 0.0,
  `c_landdate` DATE NOT NULL,
  PRIMARY KEY (`id`, `LC#`),
  INDEX `fk_LCconsignments_idx` (`LC#` ASC),
  CONSTRAINT `fk_LCconsignments`
    FOREIGN KEY (`LC#`)
    REFERENCES `xeqtionr_nano_db`.`LCS` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `xeqtionr_nano_db`.`CONSIGNMENT_CONTAINERS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `xeqtionr_nano_db`.`CONSIGNMENT_CONTAINERS` ;

CREATE TABLE IF NOT EXISTS `xeqtionr_nano_db`.`CONSIGNMENT_CONTAINERS` (
  `Container#` VARCHAR(45) NOT NULL,
  `BOL#` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`Container#`, `BOL#`),
  INDEX `fk_CONSIGNMENTcontainer_idx` (`BOL#` ASC),
  CONSTRAINT `fk_CONSIGNMENTcontainer`
    FOREIGN KEY (`BOL#`)
    REFERENCES `xeqtionr_nano_db`.`CONSIGNMENTS` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `xeqtionr_nano_db`.`CONSIGNMENT_EXPENSES`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `xeqtionr_nano_db`.`CONSIGNMENT_EXPENSES` ;

CREATE TABLE IF NOT EXISTS `xeqtionr_nano_db`.`CONSIGNMENT_EXPENSES` (
  `BOL#` VARCHAR(30) NOT NULL,
  `expenseid` INT NOT NULL AUTO_INCREMENT,
  `expense_foreign` DECIMAL(10,2) NOT NULL DEFAULT 0.0,
  `expense_local` DECIMAL(10,2) NOT NULL DEFAULT 0.0,
  `expense_notes` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`expenseid`, `BOL#`),
  INDEX `fk_CONSIGNMENTexpenses_idx` (`BOL#` ASC),
  CONSTRAINT `fk_CONSIGNMENTexpenses`
    FOREIGN KEY (`BOL#`)
    REFERENCES `xeqtionr_nano_db`.`CONSIGNMENTS` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `xeqtionr_nano_db`.`CONTAINER_CONTENTS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `xeqtionr_nano_db`.`CONTAINER_CONTENTS` ;

CREATE TABLE IF NOT EXISTS `xeqtionr_nano_db`.`CONTAINER_CONTENTS` (
  `Container#` VARCHAR(45) NOT NULL,
  `BOL#` VARCHAR(30) NOT NULL,
  `tyre_id` INT NOT NULL,
  `qty` INT NOT NULL DEFAULT 1,
  `unit_price` DECIMAL(7,2) NOT NULL,
  PRIMARY KEY (`Container#`, `BOL#`),
  INDEX `fk_TYREcontents_idx` (`tyre_id` ASC),
  CONSTRAINT `fk_CONTAINERcontents`
    FOREIGN KEY (`Container#` , `BOL#`)
    REFERENCES `xeqtionr_nano_db`.`CONSIGNMENT_CONTAINERS` (`Container#` , `BOL#`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_TYREcontents`
    FOREIGN KEY (`tyre_id`)
    REFERENCES `xeqtionr_nano_db`.`TYRES` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `xeqtionr_nano_db`.`CUSTOMERS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `xeqtionr_nano_db`.`CUSTOMERS` ;

CREATE TABLE IF NOT EXISTS `xeqtionr_nano_db`.`CUSTOMERS` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(20) NOT NULL,
  `address` VARCHAR(50) NOT NULL,
  `phone` VARCHAR(15) NULL DEFAULT NULL,
  `notes` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `xeqtionr_nano_db`.`ORDERS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `xeqtionr_nano_db`.`ORDERS` ;

CREATE TABLE IF NOT EXISTS `xeqtionr_nano_db`.`ORDERS` (
  `id` BIGINT ZEROFILL NOT NULL AUTO_INCREMENT,
  `customer_id` INT NOT NULL,
  `discount_percent` DECIMAL(5,2) NOT NULL DEFAULT 0.0,
  `discount_amount` DECIMAL(10,2) NOT NULL DEFAULT 0.0,
  `tax_percentage` DECIMAL(5,2) NOT NULL DEFAULT 0.0,
  `tax_amount` DECIMAL(10,2) NOT NULL DEFAULT 0.0,
  PRIMARY KEY (`id`),
  INDEX `fk_CUSTOMERorder_idx` (`customer_id` ASC),
  CONSTRAINT `fk_CUSTOMERorder`
    FOREIGN KEY (`customer_id`)
    REFERENCES `xeqtionr_nano_db`.`CUSTOMERS` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `xeqtionr_nano_db`.`ORDER_CONTENTS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `xeqtionr_nano_db`.`ORDER_CONTENTS` ;

CREATE TABLE IF NOT EXISTS `xeqtionr_nano_db`.`ORDER_CONTENTS` (
  `Order#` BIGINT ZEROFILL NOT NULL,
  `Tyre_id` INT NOT NULL,
  `qty` INT NOT NULL DEFAULT 1,
  `sell_price` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`Order#`, `Tyre_id`),
  INDEX `fk_ORDERtyre_idx` (`Tyre_id` ASC),
  CONSTRAINT `fk_ORDERcontents`
    FOREIGN KEY (`Order#`)
    REFERENCES `xeqtionr_nano_db`.`ORDERS` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_ORDERtyre`
    FOREIGN KEY (`Tyre_id`)
    REFERENCES `xeqtionr_nano_db`.`TYRES` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `xeqtionr_nano_db`.`PAYMENTS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `xeqtionr_nano_db`.`PAYMENTS` ;

CREATE TABLE IF NOT EXISTS `xeqtionr_nano_db`.`PAYMENTS` (
  `Order#` BIGINT ZEROFILL NOT NULL,
  `Invoice#` BIGINT NOT NULL AUTO_INCREMENT,
  `payment_amount` DECIMAL(10,2) NOT NULL DEFAULT 0,
  `payment_timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Invoice#`, `Order#`),
  CONSTRAINT `fk_ORDERSpayment`
    FOREIGN KEY (`Order#`)
    REFERENCES `xeqtionr_nano_db`.`ORDERS` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
