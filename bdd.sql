CREATE TABLE `dead` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`lastname` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`firtsname` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`happy` DATE NOT NULL,
	`happy_l` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`cause` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`maried_q` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`sexe` VARCHAR(11) NOT NULL COLLATE 'latin1_swedish_ci',
	`date_d` VARCHAR(11) NOT NULL COLLATE 'latin1_swedish_ci',
	`datecreate` DATETIME NULL DEFAULT NULL,
	`updatedate` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
;


CREATE TABLE `causes` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`cause` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`reference` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`categorie` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`createdate` DATETIME NOT NULL,
	`updatedate` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
;


CREATE TABLE `categories` (
	`id` SMALLINT(25) NOT NULL AUTO_INCREMENT,
	`categorie` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`statut` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`createdate` DATETIME NOT NULL,
	`updatedate` DATETIME NOT NULL,
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
;


