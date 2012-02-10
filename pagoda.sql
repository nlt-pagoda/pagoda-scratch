SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `pagodanlt2` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `pagodanlt2` ;

-- -----------------------------------------------------
-- Table `pagodanlt2`.`Roles`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `pagodanlt2`.`Roles` (
  `RolesID` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `role` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`RolesID`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pagodanlt2`.`User`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `pagodanlt2`.`User` (
  `UserID` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(45) NOT NULL ,
  `password` TEXT NOT NULL ,
  PRIMARY KEY (`UserID`) ,
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pagodanlt2`.`Users_has_Roles`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `pagodanlt2`.`Users_has_Roles` (
  `UsersID` INT UNSIGNED NOT NULL ,
  `RolesID` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`RolesID`, `UsersID`) ,
  INDEX `fk_Users_has_Roles_Roles1` (`RolesID` ASC) ,
  INDEX `fk_Users_has_Roles_Users` (`UsersID` ASC) ,
  CONSTRAINT `fk_Users_has_Roles_Users`
    FOREIGN KEY (`UsersID` )
    REFERENCES `pagodanlt2`.`User` (`UserID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Users_has_Roles_Roles1`
    FOREIGN KEY (`RolesID` )
    REFERENCES `pagodanlt2`.`Roles` (`RolesID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pagodanlt2`.`Course`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `pagodanlt2`.`Course` (
  `CourseID` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `CRN` INT UNSIGNED NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  `section` VARCHAR(2) NOT NULL ,
  `number` MEDIUMINT UNSIGNED NOT NULL ,
  `InstructorID` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`CourseID`) ,
  INDEX `fk_Course_Users1` (`InstructorID` ASC) ,
  CONSTRAINT `fk_Course_Users1`
    FOREIGN KEY (`InstructorID` )
    REFERENCES `pagodanlt2`.`User` (`UserID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pagodanlt2`.`Assignment`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `pagodanlt2`.`Assignment` (
  `AssignmentID` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `CourseID` INT UNSIGNED NOT NULL ,
  `description` TEXT NULL ,
  PRIMARY KEY (`AssignmentID`) ,
  INDEX `fk_Assignment_Course1` (`CourseID` ASC) ,
  CONSTRAINT `fk_Assignment_Course1`
    FOREIGN KEY (`CourseID` )
    REFERENCES `pagodanlt2`.`Course` (`CourseID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pagodanlt2`.`Document`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `pagodanlt2`.`Document` (
  `DocumentID` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `URL` VARCHAR(45) NOT NULL ,
  `AssignmentID` INT UNSIGNED NOT NULL ,
  `StudentID` INT UNSIGNED NOT NULL ,
  `grade` INT NULL ,
  PRIMARY KEY (`DocumentID`) ,
  INDEX `fk_Document_Assignment1` (`AssignmentID` ASC) ,
  INDEX `fk_Document_User1` (`StudentID` ASC) ,
  UNIQUE INDEX `URL_UNIQUE` (`URL` ASC) ,
  CONSTRAINT `fk_Document_Assignment1`
    FOREIGN KEY (`AssignmentID` )
    REFERENCES `pagodanlt2`.`Assignment` (`AssignmentID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Document_User1`
    FOREIGN KEY (`StudentID` )
    REFERENCES `pagodanlt2`.`User` (`UserID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pagodanlt2`.`Course_has_Students`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `pagodanlt2`.`Course_has_Students` (
  `CourseID` INT UNSIGNED NOT NULL ,
  `StudentID` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`CourseID`, `StudentID`) ,
  INDEX `fk_Course_has_Users_Users1` (`StudentID` ASC) ,
  INDEX `fk_Course_has_Users_Course1` (`CourseID` ASC) ,
  CONSTRAINT `fk_Course_has_Users_Course1`
    FOREIGN KEY (`CourseID` )
    REFERENCES `pagodanlt2`.`Course` (`CourseID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Course_has_Users_Users1`
    FOREIGN KEY (`StudentID` )
    REFERENCES `pagodanlt2`.`User` (`UserID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pagodanlt2`.`Message`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `pagodanlt2`.`Message` (
  `MessageID` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `message` TEXT NOT NULL ,
  `time` DATETIME NOT NULL ,
  `ToWho` INT UNSIGNED NOT NULL ,
  `FromWho` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`MessageID`) ,
  INDEX `fk_Message_Users1` (`ToWho` ASC) ,
  INDEX `fk_Message_Users2` (`FromWho` ASC) ,
  CONSTRAINT `fk_Message_Users1`
    FOREIGN KEY (`ToWho` )
    REFERENCES `pagodanlt2`.`User` (`UserID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Message_Users2`
    FOREIGN KEY (`FromWho` )
    REFERENCES `pagodanlt2`.`User` (`UserID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pagodanlt2`.`Rubric`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `pagodanlt2`.`Rubric` (
  `RubricID` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `Creator` INT UNSIGNED NOT NULL ,
  `name` VARCHAR(45) NULL ,
  PRIMARY KEY (`RubricID`) ,
  INDEX `fk_Rubric_Users1` (`Creator` ASC) ,
  CONSTRAINT `fk_Rubric_Users1`
    FOREIGN KEY (`Creator` )
    REFERENCES `pagodanlt2`.`User` (`UserID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pagodanlt2`.`Assignment_has_Rubric`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `pagodanlt2`.`Assignment_has_Rubric` (
  `AssignmentID` INT UNSIGNED NOT NULL ,
  `RubricID` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`AssignmentID`, `RubricID`) ,
  INDEX `fk_Assignment_has_Rubric_Rubric1` (`RubricID` ASC) ,
  INDEX `fk_Assignment_has_Rubric_Assignment1` (`AssignmentID` ASC) ,
  CONSTRAINT `fk_Assignment_has_Rubric_Assignment1`
    FOREIGN KEY (`AssignmentID` )
    REFERENCES `pagodanlt2`.`Assignment` (`AssignmentID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Assignment_has_Rubric_Rubric1`
    FOREIGN KEY (`RubricID` )
    REFERENCES `pagodanlt2`.`Rubric` (`RubricID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pagodanlt2`.`Criteria`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `pagodanlt2`.`Criteria` (
  `CriteriaID` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `Description` VARCHAR(45) NOT NULL ,
  `RubricID` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`CriteriaID`, `RubricID`) ,
  INDEX `fk_Criteria_Rubric1` (`RubricID` ASC) ,
  CONSTRAINT `fk_Criteria_Rubric1`
    FOREIGN KEY (`RubricID` )
    REFERENCES `pagodanlt2`.`Rubric` (`RubricID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pagodanlt2`.`Score`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `pagodanlt2`.`Score` (
  `ScoreID` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `Score` VARCHAR(45) NULL ,
  `CriteriaID` INT UNSIGNED NOT NULL ,
  `RubricID` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`ScoreID`) ,
  INDEX `fk_Score_Criteria1` (`CriteriaID` ASC, `RubricID` ASC) ,
  CONSTRAINT `fk_Score_Criteria1`
    FOREIGN KEY (`CriteriaID` , `RubricID` )
    REFERENCES `pagodanlt2`.`Criteria` (`CriteriaID` , `RubricID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pagodanlt2`.`Preferences`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `pagodanlt2`.`Preferences` (
  `idPreferences` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `UserID` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`idPreferences`) ,
  INDEX `fk_Preferences_Users1` (`UserID` ASC) ,
  CONSTRAINT `fk_Preferences_Users1`
    FOREIGN KEY (`UserID` )
    REFERENCES `pagodanlt2`.`User` (`UserID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pagodanlt2`.`Profile`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `pagodanlt2`.`Profile` (
  `ProfileID` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `fullName` VARCHAR(100) NOT NULL ,
  `emailAddress` VARCHAR(60) NOT NULL ,
  `address` TEXT NULL ,
  `UserID` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`ProfileID`) ,
  INDEX `fk_Profile_User1` (`UserID` ASC) ,
  CONSTRAINT `fk_Profile_User1`
    FOREIGN KEY (`UserID` )
    REFERENCES `pagodanlt2`.`User` (`UserID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
