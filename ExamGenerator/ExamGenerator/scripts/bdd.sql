-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Utilisateur`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Utilisateur` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(50) NOT NULL,
  `prenom` VARCHAR(50) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `dateNaissance` DATETIME NOT NULL,
  `dateCreation` DATETIME NOT NULL,
  `dateLastUpdated` DATETIME NOT NULL,
  `mdp` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Question`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Question` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nbPointsDefaut` INT NOT NULL,
  `reponse` VARCHAR(200) NULL,
  `question` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`AnneeScolaire`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`AnneeScolaire` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `dateDeb` DATETIME NOT NULL,
  `dateFin` DATETIME NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Role` (
  `idRole` INT NOT NULL AUTO_INCREMENT,
  `libelle` VARCHAR(45) NOT NULL,
  `dateLastUpdated` DATETIME NOT NULL,
  PRIMARY KEY (`idRole`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Onglet`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Onglet` (
  `idOnglet` INT NOT NULL AUTO_INCREMENT,
  `intitule` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idOnglet`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Matiere`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Matiere` (
  `idMatiere` INT NOT NULL AUTO_INCREMENT,
  `intitule` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idMatiere`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Cursus`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Cursus` (
  `idCursus` INT NOT NULL AUTO_INCREMENT,
  `libelle` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idCursus`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Niveau`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Niveau` (
  `idNiveau` INT NOT NULL AUTO_INCREMENT,
  `intitule` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`idNiveau`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`TypeEval`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`TypeEval` (
  `idTypeEval` INT NOT NULL AUTO_INCREMENT,
  `intitule` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idTypeEval`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Examen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Examen` (
  `idExamen` INT NOT NULL,
  `intitule` VARCHAR(200) NOT NULL,
  `coefficient` INT NOT NULL DEFAULT 1,
  `TypeEval_idTypeEval` INT NOT NULL,
  PRIMARY KEY (`idExamen`),
  INDEX `fk_Examen_TypeEval1_idx` (`TypeEval_idTypeEval` ASC),
  CONSTRAINT `fk_Examen_TypeEval1`
    FOREIGN KEY (`TypeEval_idTypeEval`)
    REFERENCES `mydb`.`TypeEval` (`idTypeEval`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Sujet`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Sujet` (
  `idSujet` INT NOT NULL AUTO_INCREMENT,
  `intitule` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idSujet`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`ReponseUtilisateur`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`ReponseUtilisateur` (
  `Utilisateur_id` INT NOT NULL,
  `Question_id` INT NULL,
  `dateHeure` DATETIME NOT NULL,
  `reponseSaisie` VARCHAR(255) NULL,
  `Question_id1` INT NOT NULL,
  PRIMARY KEY (`Utilisateur_id`, `Question_id1`),
  INDEX `fk_Utilisateur_has_Question_Question1_idx` (`Question_id` ASC),
  INDEX `fk_Utilisateur_has_Question_Utilisateur_idx` (`Utilisateur_id` ASC),
  INDEX `fk_ReponseUtilisateur_Question1_idx` (`Question_id1` ASC),
  CONSTRAINT `fk_Utilisateur_has_Question_Utilisateur`
    FOREIGN KEY (`Utilisateur_id`)
    REFERENCES `mydb`.`Utilisateur` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Utilisateur_has_Question_Question1`
    FOREIGN KEY (`Question_id`)
    REFERENCES `mydb`.`Question` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ReponseUtilisateur_Question1`
    FOREIGN KEY (`Question_id1`)
    REFERENCES `mydb`.`Question` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Reponse`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Reponse` (
  `idReponse` INT NOT NULL AUTO_INCREMENT,
  `saisie` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idReponse`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`ReponseQuestion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`ReponseQuestion` (
  `Reponse_idReponse` INT NOT NULL,
  `Question_id` INT NOT NULL,
  PRIMARY KEY (`Question_id`, `Reponse_idReponse`),
  INDEX `fk_Reponse_has_Question_Question1_idx` (`Question_id` ASC),
  INDEX `fk_Reponse_has_Question_Reponse1_idx` (`Reponse_idReponse` ASC),
  CONSTRAINT `fk_Reponse_has_Question_Reponse1`
    FOREIGN KEY (`Reponse_idReponse`)
    REFERENCES `mydb`.`Reponse` (`idReponse`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Reponse_has_Question_Question1`
    FOREIGN KEY (`Question_id`)
    REFERENCES `mydb`.`Question` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`QestionDansExamen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`QestionDansExamen` (
  `Question_id` INT NOT NULL,
  `Examen_idExamen` INT NOT NULL,
  `nbPointsPersonnalise` INT NULL,
  PRIMARY KEY (`Question_id`, `Examen_idExamen`),
  INDEX `fk_Question_has_Examen_Examen1_idx` (`Examen_idExamen` ASC),
  INDEX `fk_Question_has_Examen_Question1_idx` (`Question_id` ASC),
  CONSTRAINT `fk_Question_has_Examen_Question1`
    FOREIGN KEY (`Question_id`)
    REFERENCES `mydb`.`Question` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Question_has_Examen_Examen1`
    FOREIGN KEY (`Examen_idExamen`)
    REFERENCES `mydb`.`Examen` (`idExamen`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`UtilisateurRespAnnee`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`UtilisateurRespAnnee` (
  `Utilisateur_id` INT NOT NULL,
  `AnneeScolaire_id` INT NOT NULL,
  `Matiere_idMatiere` INT NOT NULL,
  PRIMARY KEY (`Utilisateur_id`, `AnneeScolaire_id`, `Matiere_idMatiere`),
  INDEX `fk_Utilisateur_has_AnneeScolaire_AnneeScolaire1_idx` (`AnneeScolaire_id` ASC),
  INDEX `fk_Utilisateur_has_AnneeScolaire_Utilisateur1_idx` (`Utilisateur_id` ASC),
  INDEX `fk_UtilisateurRespAnnee_Matiere1_idx` (`Matiere_idMatiere` ASC),
  CONSTRAINT `fk_Utilisateur_has_AnneeScolaire_Utilisateur1`
    FOREIGN KEY (`Utilisateur_id`)
    REFERENCES `mydb`.`Utilisateur` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Utilisateur_has_AnneeScolaire_AnneeScolaire1`
    FOREIGN KEY (`AnneeScolaire_id`)
    REFERENCES `mydb`.`AnneeScolaire` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_UtilisateurRespAnnee_Matiere1`
    FOREIGN KEY (`Matiere_idMatiere`)
    REFERENCES `mydb`.`Matiere` (`idMatiere`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`RoleOnglet`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`RoleOnglet` (
  `Role_idRole` INT NOT NULL,
  `Onglet_idOnglet` INT NOT NULL,
  PRIMARY KEY (`Role_idRole`, `Onglet_idOnglet`),
  INDEX `fk_Role_has_Onglet_Onglet1_idx` (`Onglet_idOnglet` ASC),
  INDEX `fk_Role_has_Onglet_Role1_idx` (`Role_idRole` ASC),
  CONSTRAINT `fk_Role_has_Onglet_Role1`
    FOREIGN KEY (`Role_idRole`)
    REFERENCES `mydb`.`Role` (`idRole`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Role_has_Onglet_Onglet1`
    FOREIGN KEY (`Onglet_idOnglet`)
    REFERENCES `mydb`.`Onglet` (`idOnglet`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`NiveauCursus`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`NiveauCursus` (
  `Niveau_idNiveau` INT NOT NULL,
  `Cursus_idCursus` INT NOT NULL,
  PRIMARY KEY (`Niveau_idNiveau`, `Cursus_idCursus`),
  INDEX `fk_Niveau_has_Cursus_Cursus1_idx` (`Cursus_idCursus` ASC),
  INDEX `fk_Niveau_has_Cursus_Niveau1_idx` (`Niveau_idNiveau` ASC),
  CONSTRAINT `fk_Niveau_has_Cursus_Niveau1`
    FOREIGN KEY (`Niveau_idNiveau`)
    REFERENCES `mydb`.`Niveau` (`idNiveau`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Niveau_has_Cursus_Cursus1`
    FOREIGN KEY (`Cursus_idCursus`)
    REFERENCES `mydb`.`Cursus` (`idCursus`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`CursusMatiere`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`CursusMatiere` (
  `Cursus_idCursus` INT NOT NULL,
  `Matiere_idMatiere` INT NOT NULL,
  PRIMARY KEY (`Cursus_idCursus`, `Matiere_idMatiere`),
  INDEX `fk_Cursus_has_Matiere_Matiere1_idx` (`Matiere_idMatiere` ASC),
  INDEX `fk_Cursus_has_Matiere_Cursus1_idx` (`Cursus_idCursus` ASC),
  CONSTRAINT `fk_Cursus_has_Matiere_Cursus1`
    FOREIGN KEY (`Cursus_idCursus`)
    REFERENCES `mydb`.`Cursus` (`idCursus`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cursus_has_Matiere_Matiere1`
    FOREIGN KEY (`Matiere_idMatiere`)
    REFERENCES `mydb`.`Matiere` (`idMatiere`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`MatiereSujet`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`MatiereSujet` (
  `Matiere_idMatiere` INT NOT NULL,
  `Sujet_idSujet` INT NOT NULL,
  PRIMARY KEY (`Matiere_idMatiere`, `Sujet_idSujet`),
  INDEX `fk_Matiere_has_Sujet_Sujet1_idx` (`Sujet_idSujet` ASC),
  INDEX `fk_Matiere_has_Sujet_Matiere1_idx` (`Matiere_idMatiere` ASC),
  CONSTRAINT `fk_Matiere_has_Sujet_Matiere1`
    FOREIGN KEY (`Matiere_idMatiere`)
    REFERENCES `mydb`.`Matiere` (`idMatiere`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Matiere_has_Sujet_Sujet1`
    FOREIGN KEY (`Sujet_idSujet`)
    REFERENCES `mydb`.`Sujet` (`idSujet`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`UtilisateurRole`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`UtilisateurRole` (
  `Utilisateur_id` INT NOT NULL,
  `Role_idRole` INT NOT NULL,
  PRIMARY KEY (`Utilisateur_id`, `Role_idRole`),
  INDEX `fk_Utilisateur_has_Role_Role1_idx` (`Role_idRole` ASC),
  INDEX `fk_Utilisateur_has_Role_Utilisateur1_idx` (`Utilisateur_id` ASC),
  CONSTRAINT `fk_Utilisateur_has_Role_Utilisateur1`
    FOREIGN KEY (`Utilisateur_id`)
    REFERENCES `mydb`.`Utilisateur` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Utilisateur_has_Role_Role1`
    FOREIGN KEY (`Role_idRole`)
    REFERENCES `mydb`.`Role` (`idRole`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`QuestionSujet`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`QuestionSujet` (
  `Question_id` INT NOT NULL,
  `Sujet_idSujet` INT NOT NULL,
  PRIMARY KEY (`Question_id`, `Sujet_idSujet`),
  INDEX `fk_Question_has_Sujet_Sujet1_idx` (`Sujet_idSujet` ASC),
  INDEX `fk_Question_has_Sujet_Question1_idx` (`Question_id` ASC),
  CONSTRAINT `fk_Question_has_Sujet_Question1`
    FOREIGN KEY (`Question_id`)
    REFERENCES `mydb`.`Question` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Question_has_Sujet_Sujet1`
    FOREIGN KEY (`Sujet_idSujet`)
    REFERENCES `mydb`.`Sujet` (`idSujet`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
