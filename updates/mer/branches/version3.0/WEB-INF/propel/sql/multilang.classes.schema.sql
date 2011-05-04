
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- multilang_text
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `multilang_text`;

CREATE TABLE `multilang_text`
(
	`id` INTEGER NOT NULL,
	`moduleName` VARCHAR(255) NOT NULL,
	`languageCode` VARCHAR(30) NOT NULL,
	`text` TEXT NOT NULL,
	PRIMARY KEY (`id`,`moduleName`,`languageCode`),
	INDEX `multilang_text_FI_1` (`languageCode`),
	INDEX `multilang_text_FI_2` (`moduleName`),
	CONSTRAINT `multilang_text_FK_1`
		FOREIGN KEY (`languageCode`)
		REFERENCES `multilang_language` (`code`)
		ON DELETE CASCADE,
	CONSTRAINT `multilang_text_FK_2`
		FOREIGN KEY (`moduleName`)
		REFERENCES `modules_module` (`name`)
) ENGINE=MyISAM CHARACTER SET='utf8' COLLATE='utf8_general_ci';

-- ---------------------------------------------------------------------
-- multilang_language
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `multilang_language`;

CREATE TABLE `multilang_language`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NOT NULL,
	`code` VARCHAR(30) NOT NULL,
	`locale` VARCHAR(30),
	PRIMARY KEY (`id`)
) ENGINE=MyISAM CHARACTER SET='utf8' COLLATE='utf8_general_ci';

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
