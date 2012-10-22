
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- services_alertSubscription
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `services_alertSubscription`;

CREATE TABLE `services_alertSubscription`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) COMMENT 'Nombre de la suscripcion',
    `entityName` VARCHAR(50) COMMENT 'Nombre unico de la entidad asociada.',
    `entityDateFieldUniqueName` VARCHAR(100) COMMENT 'Nombre unico del campo fecha',
    `entityBooleanFieldUniqueName` VARCHAR(100) COMMENT 'Nombre unico del campo a evaluar por verdadero o falso.',
    `anticipationDays` INTEGER COMMENT 'Cantidad de dias de anticipacion. Se usa para evaluar campos tipo fecha.',
    `entityNameFieldUniqueName` VARCHAR(100) COMMENT 'Campo a imprimir en representacion del nombre de cada instancia de la entidad',
    `extraRecipients` TEXT COMMENT 'Destinatarios extra',
    PRIMARY KEY (`id`),
    INDEX `services_alertSubscription_FI_1` (`entityName`),
    INDEX `services_alertSubscription_FI_2` (`entityNameFieldUniqueName`),
    INDEX `services_alertSubscription_FI_3` (`entityDateFieldUniqueName`),
    INDEX `services_alertSubscription_FI_4` (`entityBooleanFieldUniqueName`),
    CONSTRAINT `services_alertSubscription_FK_1`
        FOREIGN KEY (`entityName`)
        REFERENCES `modules_entity` (`name`)
        ON DELETE CASCADE,
    CONSTRAINT `services_alertSubscription_FK_2`
        FOREIGN KEY (`entityNameFieldUniqueName`)
        REFERENCES `modules_entityField` (`uniqueName`)
        ON DELETE CASCADE,
    CONSTRAINT `services_alertSubscription_FK_3`
        FOREIGN KEY (`entityDateFieldUniqueName`)
        REFERENCES `modules_entityField` (`uniqueName`)
        ON DELETE CASCADE,
    CONSTRAINT `services_alertSubscription_FK_4`
        FOREIGN KEY (`entityBooleanFieldUniqueName`)
        REFERENCES `modules_entityField` (`uniqueName`)
        ON DELETE CASCADE
) ENGINE=MyISAM CHARACTER SET='utf8' COLLATE='utf8_general_ci' COMMENT='Suscripciones de alerta';

-- ---------------------------------------------------------------------
-- services_alertSubscriptionUser
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `services_alertSubscriptionUser`;

CREATE TABLE `services_alertSubscriptionUser`
(
    `alertSubscriptionId` INTEGER NOT NULL,
    `userId` INTEGER NOT NULL,
    PRIMARY KEY (`alertSubscriptionId`,`userId`),
    INDEX `services_alertSubscriptionUser_FI_2` (`userId`),
    CONSTRAINT `services_alertSubscriptionUser_FK_1`
        FOREIGN KEY (`alertSubscriptionId`)
        REFERENCES `services_alertSubscription` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `services_alertSubscriptionUser_FK_2`
        FOREIGN KEY (`userId`)
        REFERENCES `users_user` (`id`)
        ON DELETE CASCADE
) ENGINE=MyISAM CHARACTER SET='utf8' COLLATE='utf8_general_ci' COMMENT='Relacion AlertSubscription - User';

-- ---------------------------------------------------------------------
-- services_scheduleSubscription
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `services_scheduleSubscription`;

CREATE TABLE `services_scheduleSubscription`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) COMMENT 'Nombre de la suscripcion',
    `entityName` VARCHAR(50) COMMENT 'Nombre unico de la entidad asociada.',
    `entityDateFieldUniqueName` VARCHAR(100) COMMENT 'Nombre unico del campo fecha',
    `entityBooleanFieldUniqueName` VARCHAR(100) COMMENT 'Nombre unico del campo a evaluar por verdadero o falso.',
    `anticipationDays` INTEGER COMMENT 'Cantidad de dias de anticipacion. Se usa para evaluar campos tipo fecha.',
    `entityNameFieldUniqueName` VARCHAR(100) COMMENT 'Campo a imprimir en representacion del nombre de cada instancia de la entidad',
    `extraRecipients` TEXT COMMENT 'Destinatarios extra',
    PRIMARY KEY (`id`),
    INDEX `services_scheduleSubscription_FI_1` (`entityName`),
    INDEX `services_scheduleSubscription_FI_2` (`entityNameFieldUniqueName`),
    INDEX `services_scheduleSubscription_FI_3` (`entityDateFieldUniqueName`),
    INDEX `services_scheduleSubscription_FI_4` (`entityBooleanFieldUniqueName`),
    CONSTRAINT `services_scheduleSubscription_FK_1`
        FOREIGN KEY (`entityName`)
        REFERENCES `modules_entity` (`name`)
        ON DELETE CASCADE,
    CONSTRAINT `services_scheduleSubscription_FK_2`
        FOREIGN KEY (`entityNameFieldUniqueName`)
        REFERENCES `modules_entityField` (`uniqueName`)
        ON DELETE CASCADE,
    CONSTRAINT `services_scheduleSubscription_FK_3`
        FOREIGN KEY (`entityDateFieldUniqueName`)
        REFERENCES `modules_entityField` (`uniqueName`)
        ON DELETE CASCADE,
    CONSTRAINT `services_scheduleSubscription_FK_4`
        FOREIGN KEY (`entityBooleanFieldUniqueName`)
        REFERENCES `modules_entityField` (`uniqueName`)
        ON DELETE CASCADE
) ENGINE=MyISAM CHARACTER SET='utf8' COLLATE='utf8_general_ci' COMMENT='Suscripciones de schedulea';

-- ---------------------------------------------------------------------
-- services_scheduleSubscriptionUser
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `services_scheduleSubscriptionUser`;

CREATE TABLE `services_scheduleSubscriptionUser`
(
    `scheduleSubscriptionId` INTEGER NOT NULL,
    `userId` INTEGER NOT NULL,
    PRIMARY KEY (`scheduleSubscriptionId`,`userId`),
    INDEX `services_scheduleSubscriptionUser_FI_2` (`userId`),
    CONSTRAINT `services_scheduleSubscriptionUser_FK_1`
        FOREIGN KEY (`scheduleSubscriptionId`)
        REFERENCES `services_scheduleSubscription` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `services_scheduleSubscriptionUser_FK_2`
        FOREIGN KEY (`userId`)
        REFERENCES `users_user` (`id`)
        ON DELETE CASCADE
) ENGINE=MyISAM CHARACTER SET='utf8' COLLATE='utf8_general_ci' COMMENT='Relacion ScheduleSubscription - User';

-- ---------------------------------------------------------------------
-- services_internalMail
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `services_internalMail`;

CREATE TABLE `services_internalMail`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `subject` VARCHAR(255) COMMENT 'Asunto',
    `body` TEXT COMMENT 'Cuerpo del mensaje',
    `recipientId` INTEGER COMMENT 'Receptor del mensaje',
    `recipientType` VARCHAR(50) COMMENT 'Tipo de receptor del mensaje',
    `readOn` DATETIME COMMENT 'Momento en que el mensaje fue leido',
    `fromId` INTEGER COMMENT 'Remitente',
    `fromType` VARCHAR(50) COMMENT 'Tipo de remitente',
    `to` LONGBLOB COMMENT 'Destinatarios',
    `replyId` INTEGER COMMENT 'Id del mensaje al que responde',
    `created_at` DATETIME,
    `updated_at` DATETIME,
    `deleted_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `services_internalMail_FI_1` (`replyId`),
    CONSTRAINT `services_internalMail_FK_1`
        FOREIGN KEY (`replyId`)
        REFERENCES `services_internalMail` (`id`)
) ENGINE=MyISAM CHARACTER SET='utf8' COLLATE='utf8_general_ci' COMMENT='Mensajes internos';

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

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
