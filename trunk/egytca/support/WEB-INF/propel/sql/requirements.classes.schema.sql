
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- requirements_requirement
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `requirements_requirement`;

CREATE TABLE `requirements_requirement`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'Headline Id',
    `name` VARCHAR(255) NOT NULL COMMENT 'Headline',
    `description` MEDIUMTEXT COMMENT 'Descripcion del proceso',
    `output` MEDIUMTEXT COMMENT 'Descripcion del resultado',
    `input` MEDIUMTEXT COMMENT 'Descripcion del ingreso de datos',
    `process` MEDIUMTEXT COMMENT 'Descripcion del ingreso de datos',
    `other` MEDIUMTEXT COMMENT 'Otras informaciones',
    `estimatedDelivery` DATETIME COMMENT 'Fecha estimada de entrega',
    `realDelivery` DATETIME COMMENT 'Fecha de Entrega',
    `delivered` BOOL DEFAULT 0 COMMENT 'entregada',
    `developmentId` INTEGER COMMENT 'Id del desarrollo',
    `clientId` INTEGER COMMENT 'Id del cliente',
    `estimatedHours` FLOAT COMMENT 'Estimacion de horas',
    `estimatedCost` FLOAT COMMENT 'Estimacion de costos',
    `realHours` FLOAT COMMENT 'Horas insumidas realmente',
    `realCost` FLOAT COMMENT 'Costos reales',
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `requirements_requirement_FI_1` (`developmentId`),
    INDEX `requirements_requirement_FI_2` (`clientId`),
    CONSTRAINT `requirements_requirement_FK_1`
        FOREIGN KEY (`developmentId`)
        REFERENCES `requirements_development` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `requirements_requirement_FK_2`
        FOREIGN KEY (`clientId`)
        REFERENCES `affiliates_affiliate` (`id`)
        ON DELETE CASCADE
) ENGINE=MyISAM CHARACTER SET='utf8' COLLATE='utf8_general_ci' COMMENT='Requerimientos';

-- ---------------------------------------------------------------------
-- requirements_development
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `requirements_development`;

CREATE TABLE `requirements_development`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'Development Id',
    `name` VARCHAR(255) NOT NULL COMMENT 'Headline',
    `description` MEDIUMTEXT COMMENT 'Descripcion del proceso',
    `output` MEDIUMTEXT COMMENT 'Descripcion del resultado',
    `input` MEDIUMTEXT COMMENT 'Descripcion del ingreso de datos',
    `process` MEDIUMTEXT COMMENT 'Descripcion del ingreso de datos',
    `other` MEDIUMTEXT COMMENT 'Otras informaciones',
    `estimatedDelivery` DATETIME COMMENT 'Fecha estimada de entrega',
    `realDelivery` DATETIME COMMENT 'Fecha de Entrega',
    `delivered` BOOL DEFAULT 0 COMMENT 'entregada',
    `clientId` INTEGER COMMENT 'Id del cliente',
    `estimatedHours` FLOAT COMMENT 'Estimacion de horas',
    `estimatedCost` FLOAT COMMENT 'Estimacion de costos',
    `realHours` FLOAT COMMENT 'Horas insumidas realmente',
    `realCost` FLOAT COMMENT 'Costos reales',
    `quotation` FLOAT COMMENT 'Cotizacion',
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `requirements_development_FI_1` (`clientId`),
    CONSTRAINT `requirements_development_FK_1`
        FOREIGN KEY (`clientId`)
        REFERENCES `affiliates_affiliate` (`id`)
        ON DELETE CASCADE
) ENGINE=MyISAM CHARACTER SET='utf8' COLLATE='utf8_general_ci' COMMENT='Desarrollo';

-- ---------------------------------------------------------------------
-- requirements_attendant
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `requirements_attendant`;

CREATE TABLE `requirements_attendant`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'Headline Id',
    `entityType` VARCHAR(255) NOT NULL COMMENT 'Tipo de requerimiento',
    `entityId` INTEGER NOT NULL COMMENT 'Id del desarrollo',
    `attendantId` INTEGER NOT NULL COMMENT 'Id del recurso',
    PRIMARY KEY (`id`),
    INDEX `requirements_attendant_FI_1` (`attendantId`),
    CONSTRAINT `requirements_attendant_FK_1`
        FOREIGN KEY (`attendantId`)
        REFERENCES `resources_resource` (`id`)
) ENGINE=MyISAM CHARACTER SET='utf8' COLLATE='utf8_general_ci' COMMENT='Recursos de Desarrollo';

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
