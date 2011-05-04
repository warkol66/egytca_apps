
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- SecurityAction
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `SecurityAction`;

CREATE TABLE `SecurityAction`
(
	`action` VARCHAR(100) NOT NULL COMMENT 'Action pagina',
	`module` VARCHAR(100) COMMENT 'Modulo',
	`section` VARCHAR(100) COMMENT 'Seccion',
	`access` INTEGER COMMENT 'El acceso a ese action',
	`active` INTEGER COMMENT 'Si el action esta activo o no',
	PRIMARY KEY (`action`)
) ENGINE=MyISAM COMMENT='Actions del sistema';

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
