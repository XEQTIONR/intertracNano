SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema xeqtionr_nano_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `xeqtionr_nano_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `xeqtionr_nano_db` ;

-- -----------------------------------------------------
-- Table `xeqtionr_nano_db`.`tyres`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `xeqtionr_nano_db`.`tyres` ;

CREATE TABLE IF NOT EXISTS `xeqtionr_nano_db`.`tyres` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tyre_brand` VARCHAR(15) NOT NULL DEFAULT 'INTERTRAC',
  `tyre_size` VARCHAR(15) NOT NULL,
  `tyre_pattern` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `xeqtionr_nano_db`.`hscodes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `xeqtionr_nano_db`.`hscodes` ;

CREATE TABLE IF NOT EXISTS `xeqtionr_nano_db`.`hscodes` (
  `id` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `xeqtionr_nano_db`.`TYRE_hscodes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `xeqtionr_nano_db`.`tyre_hscodes` ;

CREATE TABLE IF NOT EXISTS `xeqtionr_nano_db`.`tyre_hscodes` (
  `tyre_id` INT NOT NULL,
  `hscode` VARCHAR(20) NOT NULL,
  INDEX `fk_TYRE_idx` (`tyre_id` ASC),
  INDEX `fk_HSCODE_idx` (`hscode` ASC),
  CONSTRAINT `fk_TYREtyre`
    FOREIGN KEY (`tyre_id`)
    REFERENCES `xeqtionr_nano_db`.`tyres` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_HSCODEhscode`
    FOREIGN KEY (`hscode`)
    REFERENCES `xeqtionr_nano_db`.`hscodes` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `xeqtionr_nano_db`.`lcs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `xeqtionr_nano_db`.`lcs` ;

CREATE TABLE IF NOT EXISTS `xeqtionr_nano_db`.`lcs` (
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
-- Table `xeqtionr_nano_db`.`performa_invoices`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `xeqtionr_nano_db`.`performa_invoices` ;

CREATE TABLE IF NOT EXISTS `xeqtionr_nano_db`.`performa_invoices` (
  `lc#` VARCHAR(15) NOT NULL,
  `tyre_id` INT NOT NULL,
  `qty` INT NOT NULL DEFAULT 1,
  `unit_price` DECIMAL(5,2) NOT NULL,
  PRIMARY KEY (`lc#`),
  INDEX `fk_TYRE_idx` (`tyre_id` ASC),
  CONSTRAINT `fk_LCperforma`
    FOREIGN KEY (`lc#`)
    REFERENCES `xeqtionr_nano_db`.`lcs` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_TYREperforma`
    FOREIGN KEY (`tyre_id`)
    REFERENCES `xeqtionr_nano_db`.`tyres` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `xeqtionr_nano_db`.`consignments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `xeqtionr_nano_db`.`consignments` ;

CREATE TABLE IF NOT EXISTS `xeqtionr_nano_db`.`consignments` (
  `id` VARCHAR(30) NOT NULL DEFAULT 'CONSIGNMENT ID / BOL#',
  `LC#` VARCHAR(15) NOT NULL,
  `c_val` DECIMAL(10,2) NOT NULL,
  `c_Tax` DECIMAL(10,2) NOT NULL DEFAULT 0.0,
  `c_landdate` DATE NOT NULL,
  PRIMARY KEY (`id`, `LC#`),
  INDEX `fk_LCconsignments_idx` (`LC#` ASC),
  CONSTRAINT `fk_LCconsignments`
    FOREIGN KEY (`LC#`)
    REFERENCES `xeqtionr_nano_db`.`lcs` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `xeqtionr_nano_db`.`consignment_containers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `xeqtionr_nano_db`.`consignment_containers` ;

CREATE TABLE IF NOT EXISTS `xeqtionr_nano_db`.`consignment_containers` (
  `Container#` VARCHAR(45) NOT NULL,
  `BOL#` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`Container#`, `BOL#`),
  INDEX `fk_CONSIGNMENTcontainer_idx` (`BOL#` ASC),
  CONSTRAINT `fk_CONSIGNMENTcontainer`
    FOREIGN KEY (`BOL#`)
    REFERENCES `xeqtionr_nano_db`.`consignments` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `xeqtionr_nano_db`.`consignment_expenses`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `xeqtionr_nano_db`.`consignment_expenses` ;

CREATE TABLE IF NOT EXISTS `xeqtionr_nano_db`.`consignment_expenses` (
  `BOL#` VARCHAR(30) NOT NULL,
  `expenseid` INT NOT NULL AUTO_INCREMENT,
  `expense_foreign` DECIMAL(10,2) NOT NULL DEFAULT 0.0,
  `expense_local` DECIMAL(10,2) NOT NULL DEFAULT 0.0,
  `expense_notes` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`expenseid`, `BOL#`),
  INDEX `fk_CONSIGNMENTexpenses_idx` (`BOL#` ASC),
  CONSTRAINT `fk_CONSIGNMENTexpenses`
    FOREIGN KEY (`BOL#`)
    REFERENCES `xeqtionr_nano_db`.`consignments` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `xeqtionr_nano_db`.`container_contents`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `xeqtionr_nano_db`.`container_contents` ;

CREATE TABLE IF NOT EXISTS `xeqtionr_nano_db`.`container_contents` (
  `Container#` VARCHAR(45) NOT NULL,
  `BOL#` VARCHAR(30) NOT NULL,
  `tyre_id` INT NOT NULL,
  `qty` INT NOT NULL DEFAULT 1,
  `unit_price` DECIMAL(7,2) NOT NULL,
  PRIMARY KEY (`Container#`, `BOL#`, `tyre_id`),
  INDEX `fk_TYREcontents_idx` (`tyre_id` ASC),
  CONSTRAINT `fk_CONTAINERcontents`
    FOREIGN KEY (`Container#` , `BOL#`)
    REFERENCES `xeqtionr_nano_db`.`consignment_containers` (`Container#` , `BOL#`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_TYREcontents`
    FOREIGN KEY (`tyre_id`)
    REFERENCES `xeqtionr_nano_db`.`tyres` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `xeqtionr_nano_db`.`customers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `xeqtionr_nano_db`.`customers` ;

CREATE TABLE IF NOT EXISTS `xeqtionr_nano_db`.`customers` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(20) NOT NULL,
  `address` VARCHAR(50) NOT NULL,
  `phone` VARCHAR(15) NULL DEFAULT NULL,
  `notes` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `xeqtionr_nano_db`.`orders`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `xeqtionr_nano_db`.`orders` ;

CREATE TABLE IF NOT EXISTS `xeqtionr_nano_db`.`orders` (
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
    REFERENCES `xeqtionr_nano_db`.`customers` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `xeqtionr_nano_db`.`order_contents`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `xeqtionr_nano_db`.`order_contents` ;

CREATE TABLE IF NOT EXISTS `xeqtionr_nano_db`.`order_contents` (
  `Order#` BIGINT ZEROFILL NOT NULL,
  `Container#` VARCHAR(45) NOT NULL,
  `BOL#` VARCHAR(30) NOT NULL,
  `Tyre_id` INT NOT NULL,
  `qty` INT NOT NULL DEFAULT 1,
  `sell_price` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`Order#`, `Container#`, `BOL#`,`Tyre_id`),
  INDEX `fk_ORDERtyre_idx` (`Tyre_id` ASC),
  CONSTRAINT `fk_ORDERcontents`
    FOREIGN KEY (`Order#`)
    REFERENCES `xeqtionr_nano_db`.`orders` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_ORDERcontainerContents`
    FOREIGN KEY (`Container#` ,`BOL#` , `Tyre_id`)
    REFERENCES `xeqtionr_nano_db`.`container_contents` (`Container#` ,`BOL#` , `tyre_id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `xeqtionr_nano_db`.`payments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `xeqtionr_nano_db`.`payments` ;

CREATE TABLE IF NOT EXISTS `xeqtionr_nano_db`.`payments` (
  `Order#` BIGINT ZEROFILL NOT NULL,
  `Invoice#` BIGINT NOT NULL AUTO_INCREMENT,
  `payment_amount` DECIMAL(10,2) NOT NULL DEFAULT 0,
  `payment_timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Invoice#`, `Order#`),
  CONSTRAINT `fk_orderspayment`
    FOREIGN KEY (`Order#`)
    REFERENCES `xeqtionr_nano_db`.`orders` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
