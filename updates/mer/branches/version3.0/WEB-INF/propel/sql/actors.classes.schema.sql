
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- MER_actor
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `MER_actor`;

CREATE TABLE `MER_actor`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL COMMENT 'actor\'s name',
	`categoryId` INTEGER,
	`active` TINYINT NOT NULL,
	`strategy` VARCHAR(255) COMMENT 'Estrategia',
	`tactic` VARCHAR(255) COMMENT 'Tactica',
	`observations` VARCHAR(255) COMMENT 'Observaciones',
	PRIMARY KEY (`id`),
	INDEX `MER_actor_FI_1` (`categoryId`),
	CONSTRAINT `MER_actor_FK_1`
		FOREIGN KEY (`categoryId`)
		REFERENCES `MER_category` (`id`)
) ENGINE=MyISAM COMMENT='Actors';

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
