
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- affiliates_affiliate
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `affiliates_affiliate`;

CREATE TABLE `affiliates_affiliate`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'Id afiliado',
    `name` VARCHAR(255) NOT NULL COMMENT 'nombre afiliado',
    `ownerId` INTEGER COMMENT 'Id del usuario administrador del afiliado',
    `internalNumber` VARCHAR(12) COMMENT 'Id interno',
    `address` VARCHAR(255) COMMENT 'Direccion afiliado',
    `phone` VARCHAR(50) COMMENT 'Telefono afiliado',
    `email` VARCHAR(50) COMMENT 'Email afiliado',
    `contact` VARCHAR(50) COMMENT 'Nombre de persona de contacto',
    `contactEmail` VARCHAR(100) COMMENT 'Email de persona de contacto',
    `web` VARCHAR(255) COMMENT 'Direccion web del afiliado',
    `memo` TEXT COMMENT 'Informacion adicional del afiliado',
    `class_key` INTEGER,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `affiliates_affiliate_FI_1` (`ownerId`),
    CONSTRAINT `affiliates_affiliate_FK_1`
        FOREIGN KEY (`ownerId`)
        REFERENCES `affiliates_user` (`id`)
) ENGINE=MyISAM CHARACTER SET='utf8' COLLATE='utf8_general_ci' COMMENT='Afiliados';

-- ---------------------------------------------------------------------
-- affiliates_user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `affiliates_user`;

CREATE TABLE `affiliates_user`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'User Id',
    `affiliateId` INTEGER NOT NULL COMMENT 'Id afiliado',
    `username` VARCHAR(255) NOT NULL COMMENT 'username',
    `password` VARCHAR(255) NOT NULL COMMENT 'password',
    `passwordUpdated` DATE COMMENT 'Fecha de actualizacion de la clave',
    `levelId` INTEGER COMMENT 'User Level',
    `lastLogin` DATETIME COMMENT 'Fecha del ultimo login del usuario',
    `timezone` VARCHAR(25) COMMENT 'Timezone GMT del usuario',
    `name` VARCHAR(255) COMMENT 'name',
    `surname` VARCHAR(255) COMMENT 'surname',
    `mailAddress` VARCHAR(255) COMMENT 'Email',
    `mailAddressAlt` VARCHAR(90) COMMENT 'Direccion electronica alternativa',
    `recoveryHash` VARCHAR(255) COMMENT 'Hash enviado para la recuperacion de clave',
    `recoveryHashCreatedOn` DATETIME COMMENT 'Momento de la solicitud para la recuperacion de clave',
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `affiliates_user_U_1` (`username`),
    INDEX `affiliates_user_FI_1` (`levelId`),
    INDEX `affiliates_user_FI_2` (`affiliateId`),
    CONSTRAINT `affiliates_user_FK_1`
        FOREIGN KEY (`levelId`)
        REFERENCES `affiliates_level` (`id`),
    CONSTRAINT `affiliates_user_FK_2`
        FOREIGN KEY (`affiliateId`)
        REFERENCES `affiliates_affiliate` (`id`)
) ENGINE=MyISAM CHARACTER SET='utf8' COLLATE='utf8_general_ci' COMMENT='Usuarios de afiliado';

-- ---------------------------------------------------------------------
-- affiliates_level
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `affiliates_level`;

CREATE TABLE `affiliates_level`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'Level ID',
    `name` VARCHAR(255) NOT NULL COMMENT 'Level Name',
    `bitLevel` INTEGER COMMENT 'Bit del nivel',
    PRIMARY KEY (`id`),
    UNIQUE INDEX `affiliates_level_U_1` (`name`)
) ENGINE=MyISAM CHARACTER SET='utf8' COLLATE='utf8_general_ci' COMMENT='Levels';

-- ---------------------------------------------------------------------
-- affiliates_userGroup
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `affiliates_userGroup`;

CREATE TABLE `affiliates_userGroup`
(
    `userId` INTEGER NOT NULL COMMENT 'Group ID',
    `groupId` INTEGER NOT NULL COMMENT 'Group ID',
    PRIMARY KEY (`userId`,`groupId`),
    INDEX `affiliates_userGroup_FI_2` (`groupId`),
    CONSTRAINT `affiliates_userGroup_FK_1`
        FOREIGN KEY (`userId`)
        REFERENCES `affiliates_user` (`id`),
    CONSTRAINT `affiliates_userGroup_FK_2`
        FOREIGN KEY (`groupId`)
        REFERENCES `affiliates_group` (`id`)
        ON DELETE CASCADE
) ENGINE=MyISAM COMMENT='Users / Groups';

-- ---------------------------------------------------------------------
-- affiliates_group
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `affiliates_group`;

CREATE TABLE `affiliates_group`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'Group ID',
    `name` VARCHAR(255) NOT NULL COMMENT 'Group Name',
    `created` DATETIME NOT NULL COMMENT 'Creation date for',
    `updated` DATETIME NOT NULL COMMENT 'Last update date',
    `bitLevel` INTEGER COMMENT 'Nivel',
    PRIMARY KEY (`id`),
    UNIQUE INDEX `affiliates_group_U_1` (`name`)
) ENGINE=MyISAM CHARACTER SET='utf8' COLLATE='utf8_general_ci' COMMENT='Groups';

-- ---------------------------------------------------------------------
-- affiliates_branch
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `affiliates_branch`;

CREATE TABLE `affiliates_branch`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'Id de la sucursal',
    `affiliateId` INTEGER NOT NULL COMMENT 'Id del afiliado',
    `number` INTEGER NOT NULL COMMENT 'Numero de la sucursal',
    `code` VARCHAR(20) COMMENT 'Codigo de la sucursal',
    `name` VARCHAR(255) COMMENT 'Nombre de la sucursal',
    `phone` VARCHAR(100) COMMENT 'Telefono de la sucursal',
    `contact` VARCHAR(50) COMMENT 'Nombre de persona de contacto',
    `contactEmail` VARCHAR(100) COMMENT 'Email de persona de contacto',
    `memo` TEXT COMMENT 'Informacion adicional de la sucursal',
    PRIMARY KEY (`id`),
    INDEX `affiliates_branch_FI_1` (`affiliateId`),
    CONSTRAINT `affiliates_branch_FK_1`
        FOREIGN KEY (`affiliateId`)
        REFERENCES `affiliates_affiliate` (`id`)
) ENGINE=MyISAM CHARACTER SET='utf8' COLLATE='utf8_general_ci' COMMENT='Sucursales de Afiliados';

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
