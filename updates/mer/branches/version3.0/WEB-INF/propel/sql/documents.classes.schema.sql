
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- MER_document
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `MER_document`;

CREATE TABLE `MER_document`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'Id documento',
	`filename` VARCHAR(255) COMMENT 'El nombre del archivo',
	`realFilename` VARCHAR(255) COMMENT 'El nombre real del archivo',
	`date` DATE COMMENT 'Fecha',
	`categoryId` INTEGER COMMENT 'Numero de tipo de archivo',
	`description` VARCHAR(255) COMMENT 'Descripcion del archivo',
	`document_date` DATE COMMENT 'Fecha del documento',
	`password` VARCHAR(32) COMMENT 'Clave del archivo',
	`fullTextContent` MEDIUMTEXT COMMENT 'Contenido del archivo',
	PRIMARY KEY (`id`),
	INDEX `MER_document_FI_1` (`categoryId`),
	CONSTRAINT `MER_document_FK_1`
		FOREIGN KEY (`categoryId`)
		REFERENCES `MER_category` (`id`)
		ON DELETE CASCADE
) ENGINE=MyISAM CHARACTER SET='utf8' COLLATE='utf8_general_ci' COMMENT='Documentos del sistema';

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
