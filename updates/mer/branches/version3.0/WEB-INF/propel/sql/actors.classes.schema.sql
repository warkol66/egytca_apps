
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- MER_actor
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `MER_actor`;

CREATE TABLE `MER_actor`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'actor\'s Id',
	`title` VARCHAR(30) NOT NULL COMMENT 'actor\'s title',
	`name` VARCHAR(100) NOT NULL COMMENT 'actor\'s name',
	`surname` VARCHAR(100) NOT NULL COMMENT 'actor\'s surname',
	`categoryId` INTEGER,
	`active` BOOL DEFAULT 1 NOT NULL COMMENT 'to be deleted!!!',
	`strategy` MEDIUMTEXT COMMENT 'Estrategia',
	`tactic` MEDIUMTEXT COMMENT 'Tactica',
	`comments` MEDIUMTEXT COMMENT 'Comentarios',
	`observations` MEDIUMTEXT COMMENT 'Observaciones to be deleted',
	`deleted_at` DATETIME,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `MER_actor_FI_1` (`categoryId`),
	CONSTRAINT `MER_actor_FK_1`
		FOREIGN KEY (`categoryId`)
		REFERENCES `MER_category` (`id`)
) ENGINE=MyISAM CHARACTER SET='utf8' COLLATE='utf8_general_ci' COMMENT='Actors';

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
