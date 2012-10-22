
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- actionLogs_log
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `actionLogs_log`;

CREATE TABLE `actionLogs_log`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'Id log',
    `userObjectType` VARCHAR(50) NOT NULL COMMENT 'Tipo de usuario',
    `userObjectId` INTEGER NOT NULL COMMENT 'Id del usuario',
    `datetime` DATETIME NOT NULL COMMENT 'Fecha en que se logueo el dato',
    `action` VARCHAR(100) NOT NULL COMMENT 'action en que se logueo el dato',
    `message` VARCHAR(255) COMMENT 'Mensaje resultado de la accion',
    `forward` VARCHAR(100) COMMENT 'tipo de accion de la etiqueta',
    PRIMARY KEY (`id`),
    INDEX `actionLogs_log_FI_1` (`action`),
    CONSTRAINT `actionLogs_log_FK_1`
        FOREIGN KEY (`action`)
        REFERENCES `security_action` (`action`)
) ENGINE=MyISAM CHARACTER SET='utf8' COLLATE='utf8_general_ci' COMMENT='logs de acciones del sistema';

-- ---------------------------------------------------------------------
-- actionLogs_label
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `actionLogs_label`;

CREATE TABLE `actionLogs_label`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'Id Label',
    `action` VARCHAR(100) NOT NULL COMMENT 'action en que se loguea el dato',
    `label` VARCHAR(100) NOT NULL COMMENT 'mensaje del log',
    `language` VARCHAR(100) COMMENT 'idioma de la etiqueta',
    `forward` VARCHAR(100) COMMENT 'tipo de accion de la etiqueta',
    PRIMARY KEY (`id`,`action`)
) ENGINE=MyISAM CHARACTER SET='utf8' COLLATE='utf8_general_ci' COMMENT='Etiquetas de los logs';

-- ---------------------------------------------------------------------
-- common_menuItem
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `common_menuItem`;

CREATE TABLE `common_menuItem`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `action` VARCHAR(100) COMMENT 'Nombre de la accion a ejecutar',
    `url` VARCHAR(255) COMMENT 'Direccion del enlace',
    `order` INTEGER COMMENT 'Indice de ordenamiento',
    `parentId` INTEGER COMMENT 'Id item padre',
    `newWindow` BOOL DEFAULT 0 NOT NULL COMMENT 'Abrir el enlace en nueva ventana',
    PRIMARY KEY (`id`)
) ENGINE=MyISAM CHARACTER SET='utf8' COLLATE='utf8_general_ci' COMMENT='Items de los menues dinamicos';

-- ---------------------------------------------------------------------
-- common_menuItemInfo
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `common_menuItemInfo`;

CREATE TABLE `common_menuItemInfo`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `menuItemId` INTEGER NOT NULL,
    `name` VARCHAR(100) NOT NULL COMMENT 'Nombre a mostrar en el item',
    `title` VARCHAR(255) COMMENT 'Titulo a mostrar en el item',
    `description` TEXT COMMENT 'Descripcion del item',
    `language` VARCHAR(100) NOT NULL COMMENT 'Idioma',
    PRIMARY KEY (`id`),
    INDEX `common_menuItemInfo_FI_1` (`menuItemId`),
    CONSTRAINT `common_menuItemInfo_FK_1`
        FOREIGN KEY (`menuItemId`)
        REFERENCES `common_menuItem` (`id`)
        ON DELETE CASCADE
) ENGINE=MyISAM CHARACTER SET='utf8' COLLATE='utf8_general_ci' COMMENT='Items de los menues dinamicos';

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
