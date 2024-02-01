DROP TABLE IF EXISTS `response`;
DROP TABLE IF EXISTS `sondage`;
DROP TABLE IF EXISTS `utilisateur`;

CREATE TABLE `reponse` (
    `idr` INT NOT NULL AUTO_INCREMENT,
    `creneau` VARCHAR(255) NOT NULL,
    `id_sondage` INT NOT NULL,
    `description` VARCHAR(255) NOT NULL,
    `pseudo` VARCHAR(255) NOT NULL,
    `id_createur` INT NOT NULL,
    PRIMARY KEY(`idr`)
);

CREATE TABLE `sondage` (
    `ids` INT NOT NULL AUTO_INCREMENT,
    `titre` VARCHAR(255) NOT NULL,
    `hash_titre` VARCHAR(255) NOT NULL,
	`description` TEXT NOT NULL,
	`lieu` VARCHAR(255) NOT NULL,
	`date1` DATE NOT NULL,
	`heure1` TIME NOT NULL,
	`date2` DATE,
    `heure2` TIME,
	`date3` DATE,
	`heure3` TIME,
	`id_utilisateur` INT NOT NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `closed_survey` BOOLEAN NOT NULL,
    PRIMARY KEY(`ids`)
);

CREATE TABLE `utilisateur` (
    `idu` INT NOT NULL AUTO_INCREMENT,
    `nom` VARCHAR(255) NOT NULL,
    `prenom` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `pseudo` VARCHAR(255) NOT NULL,
    `mot_de_passe` VARCHAR(255) NOT NULL,
    PRIMARY KEY(`idu`)
);

ALTER TABLE `reponse` 
    ADD CONSTRAINT `reponse_ibfk_1` FOREIGN KEY (`id_sondage`) REFERENCES `sondage` (`ids`),
    ADD CONSTRAINT `reponse_ibfk_2` FOREIGN KEY (`id_createur`) REFERENCES `utilisateur` (`idu`);
ALTER TABLE `sondage` 
    ADD CONSTRAINT `sondage_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`idu`);