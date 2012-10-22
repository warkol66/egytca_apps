
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- resources_resource
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `resources_resource`;

CREATE TABLE `resources_resource`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'Identificacion del recurso',
    `title` VARCHAR(255) COMMENT 'Titulo',
    `description` VARCHAR(255) COMMENT 'Descripcion',
    `path` VARCHAR(255) COMMENT 'URI del recurso',
    PRIMARY KEY (`id`)
) ENGINE=MyISAM CHARACTER SET='utf8' COLLATE='utf8_general_ci' COMMENT='Recursos';

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
