<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1350315994.
 * Generated on 2012-10-15 12:46:34 by sol
 */
class PropelMigration_1350315994
{

    public function preUp($manager)
    {
        // add the pre-migration code here
    }

    public function postUp($manager)
    {
        // add the post-migration code here
    }

    public function preDown($manager)
    {
        // add the pre-migration code here
    }

    public function postDown($manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'application' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `affiliates_affiliate`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT COMMENT \'Id afiliado\',
    `name` VARCHAR(255) NOT NULL COMMENT \'nombre afiliado\',
    `ownerId` INTEGER COMMENT \'Id del usuario administrador del afiliado\',
    `internalNumber` VARCHAR(12) COMMENT \'Id interno\',
    `address` VARCHAR(255) COMMENT \'Direccion afiliado\',
    `phone` VARCHAR(50) COMMENT \'Telefono afiliado\',
    `email` VARCHAR(50) COMMENT \'Email afiliado\',
    `contact` VARCHAR(50) COMMENT \'Nombre de persona de contacto\',
    `contactEmail` VARCHAR(100) COMMENT \'Email de persona de contacto\',
    `web` VARCHAR(255) COMMENT \'Direccion web del afiliado\',
    `memo` TEXT COMMENT \'Informacion adicional del afiliado\',
    `class_key` INTEGER,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `affiliates_affiliate_FI_1` (`ownerId`),
    CONSTRAINT `affiliates_affiliate_FK_1`
        FOREIGN KEY (`ownerId`)
        REFERENCES `affiliates_user` (`id`)
) ENGINE=MyISAM CHARACTER SET=\'utf8\' COLLATE=\'utf8_general_ci\' COMMENT=\'Afiliados\';

CREATE TABLE `affiliates_user`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT COMMENT \'User Id\',
    `affiliateId` INTEGER NOT NULL COMMENT \'Id afiliado\',
    `username` VARCHAR(255) NOT NULL COMMENT \'username\',
    `password` VARCHAR(255) NOT NULL COMMENT \'password\',
    `passwordUpdated` DATE COMMENT \'Fecha de actualizacion de la clave\',
    `levelId` INTEGER COMMENT \'User Level\',
    `lastLogin` DATETIME COMMENT \'Fecha del ultimo login del usuario\',
    `timezone` VARCHAR(25) COMMENT \'Timezone GMT del usuario\',
    `name` VARCHAR(255) COMMENT \'name\',
    `surname` VARCHAR(255) COMMENT \'surname\',
    `mailAddress` VARCHAR(255) COMMENT \'Email\',
    `mailAddressAlt` VARCHAR(90) COMMENT \'Direccion electronica alternativa\',
    `recoveryHash` VARCHAR(255) COMMENT \'Hash enviado para la recuperacion de clave\',
    `recoveryHashCreatedOn` DATETIME COMMENT \'Momento de la solicitud para la recuperacion de clave\',
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
) ENGINE=MyISAM CHARACTER SET=\'utf8\' COLLATE=\'utf8_general_ci\' COMMENT=\'Usuarios de afiliado\';

CREATE TABLE `affiliates_level`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT COMMENT \'Level ID\',
    `name` VARCHAR(255) NOT NULL COMMENT \'Level Name\',
    `bitLevel` INTEGER COMMENT \'Bit del nivel\',
    PRIMARY KEY (`id`),
    UNIQUE INDEX `affiliates_level_U_1` (`name`)
) ENGINE=MyISAM CHARACTER SET=\'utf8\' COLLATE=\'utf8_general_ci\' COMMENT=\'Levels\';

CREATE TABLE `affiliates_userGroup`
(
    `userId` INTEGER NOT NULL COMMENT \'Group ID\',
    `groupId` INTEGER NOT NULL COMMENT \'Group ID\',
    PRIMARY KEY (`userId`,`groupId`),
    INDEX `affiliates_userGroup_FI_2` (`groupId`),
    CONSTRAINT `affiliates_userGroup_FK_1`
        FOREIGN KEY (`userId`)
        REFERENCES `affiliates_user` (`id`),
    CONSTRAINT `affiliates_userGroup_FK_2`
        FOREIGN KEY (`groupId`)
        REFERENCES `affiliates_group` (`id`)
        ON DELETE CASCADE
) ENGINE=MyISAM COMMENT=\'Users / Groups\';

CREATE TABLE `affiliates_group`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT COMMENT \'Group ID\',
    `name` VARCHAR(255) NOT NULL COMMENT \'Group Name\',
    `created` DATETIME NOT NULL COMMENT \'Creation date for\',
    `updated` DATETIME NOT NULL COMMENT \'Last update date\',
    `bitLevel` INTEGER COMMENT \'Nivel\',
    PRIMARY KEY (`id`),
    UNIQUE INDEX `affiliates_group_U_1` (`name`)
) ENGINE=MyISAM CHARACTER SET=\'utf8\' COLLATE=\'utf8_general_ci\' COMMENT=\'Groups\';

CREATE TABLE `affiliates_branch`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT COMMENT \'Id de la sucursal\',
    `affiliateId` INTEGER NOT NULL COMMENT \'Id del afiliado\',
    `number` INTEGER NOT NULL COMMENT \'Numero de la sucursal\',
    `code` VARCHAR(20) COMMENT \'Codigo de la sucursal\',
    `name` VARCHAR(255) COMMENT \'Nombre de la sucursal\',
    `phone` VARCHAR(100) COMMENT \'Telefono de la sucursal\',
    `contact` VARCHAR(50) COMMENT \'Nombre de persona de contacto\',
    `contactEmail` VARCHAR(100) COMMENT \'Email de persona de contacto\',
    `memo` TEXT COMMENT \'Informacion adicional de la sucursal\',
    PRIMARY KEY (`id`),
    INDEX `affiliates_branch_FI_1` (`affiliateId`),
    CONSTRAINT `affiliates_branch_FK_1`
        FOREIGN KEY (`affiliateId`)
        REFERENCES `affiliates_affiliate` (`id`)
) ENGINE=MyISAM CHARACTER SET=\'utf8\' COLLATE=\'utf8_general_ci\' COMMENT=\'Sucursales de Afiliados\';

CREATE TABLE `categories_category`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT COMMENT \'Id de la categoria\',
    `name` VARCHAR(255) NOT NULL COMMENT \'Category name\',
    `module` VARCHAR(255) DEFAULT \'\' COMMENT \'Module name if it is for a module\',
    `active` TINYINT(1) NOT NULL COMMENT \'Is category active?\',
    `isPublic` TINYINT(1) DEFAULT 0 NOT NULL COMMENT \'Is category public?\',
    `responsible` VARCHAR(255) NOT NULL COMMENT \'Responsable de la dependendencia\',
    `deleted_at` DATETIME,
    `tree_left` INTEGER,
    `tree_right` INTEGER,
    `tree_level` INTEGER,
    `scope` INTEGER,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM CHARACTER SET=\'utf8\' COLLATE=\'utf8_general_ci\' COMMENT=\'Categorias\';

CREATE TABLE `users_groupCategory`
(
    `groupId` INTEGER NOT NULL COMMENT \'Group ID\',
    `categoryId` INTEGER NOT NULL COMMENT \'Category ID\',
    PRIMARY KEY (`groupId`,`categoryId`),
    INDEX `users_groupCategory_FI_2` (`categoryId`),
    CONSTRAINT `users_groupCategory_FK_1`
        FOREIGN KEY (`groupId`)
        REFERENCES `users_group` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `users_groupCategory_FK_2`
        FOREIGN KEY (`categoryId`)
        REFERENCES `categories_category` (`id`)
        ON DELETE CASCADE
) ENGINE=MyISAM CHARACTER SET=\'utf8\' COLLATE=\'utf8_general_ci\' COMMENT=\'Groups_Categories\';

CREATE TABLE `actionLogs_log`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT COMMENT \'Id log\',
    `userObjectType` VARCHAR(50) NOT NULL COMMENT \'Tipo de usuario\',
    `userObjectId` INTEGER NOT NULL COMMENT \'Id del usuario\',
    `datetime` DATETIME NOT NULL COMMENT \'Fecha en que se logueo el dato\',
    `action` VARCHAR(100) NOT NULL COMMENT \'action en que se logueo el dato\',
    `message` VARCHAR(255) COMMENT \'Mensaje resultado de la accion\',
    `forward` VARCHAR(100) COMMENT \'tipo de accion de la etiqueta\',
    PRIMARY KEY (`id`),
    INDEX `actionLogs_log_FI_1` (`action`),
    CONSTRAINT `actionLogs_log_FK_1`
        FOREIGN KEY (`action`)
        REFERENCES `security_action` (`action`)
) ENGINE=MyISAM CHARACTER SET=\'utf8\' COLLATE=\'utf8_general_ci\' COMMENT=\'logs de acciones del sistema\';

CREATE TABLE `actionLogs_label`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT COMMENT \'Id Label\',
    `action` VARCHAR(100) NOT NULL COMMENT \'action en que se loguea el dato\',
    `label` VARCHAR(100) NOT NULL COMMENT \'mensaje del log\',
    `language` VARCHAR(100) COMMENT \'idioma de la etiqueta\',
    `forward` VARCHAR(100) COMMENT \'tipo de accion de la etiqueta\',
    PRIMARY KEY (`id`,`action`)
) ENGINE=MyISAM CHARACTER SET=\'utf8\' COLLATE=\'utf8_general_ci\' COMMENT=\'Etiquetas de los logs\';

CREATE TABLE `common_menuItem`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `action` VARCHAR(100) COMMENT \'Nombre de la accion a ejecutar\',
    `url` VARCHAR(255) COMMENT \'Direccion del enlace\',
    `order` INTEGER COMMENT \'Indice de ordenamiento\',
    `parentId` INTEGER COMMENT \'Id item padre\',
    `newWindow` BOOL DEFAULT 0 NOT NULL COMMENT \'Abrir el enlace en nueva ventana\',
    PRIMARY KEY (`id`)
) ENGINE=MyISAM CHARACTER SET=\'utf8\' COLLATE=\'utf8_general_ci\' COMMENT=\'Items de los menues dinamicos\';

CREATE TABLE `common_menuItemInfo`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `menuItemId` INTEGER NOT NULL,
    `name` VARCHAR(100) NOT NULL COMMENT \'Nombre a mostrar en el item\',
    `title` VARCHAR(255) COMMENT \'Titulo a mostrar en el item\',
    `description` TEXT COMMENT \'Descripcion del item\',
    `language` VARCHAR(100) NOT NULL COMMENT \'Idioma\',
    PRIMARY KEY (`id`),
    INDEX `common_menuItemInfo_FI_1` (`menuItemId`),
    CONSTRAINT `common_menuItemInfo_FK_1`
        FOREIGN KEY (`menuItemId`)
        REFERENCES `common_menuItem` (`id`)
        ON DELETE CASCADE
) ENGINE=MyISAM CHARACTER SET=\'utf8\' COLLATE=\'utf8_general_ci\' COMMENT=\'Items de los menues dinamicos\';

CREATE TABLE `modules_module`
(
    `name` VARCHAR(255) NOT NULL COMMENT \'nombre del modulo\',
    `active` TINYINT(1) DEFAULT 0 NOT NULL COMMENT \'Estado del modulo\',
    `alwaysActive` TINYINT(1) DEFAULT 0 NOT NULL COMMENT \'Modulo siempre activo\',
    `hasCategories` TINYINT(1) DEFAULT 0 NOT NULL COMMENT \'El Modulo tiene categorias relacionadas?\',
    PRIMARY KEY (`name`)
) ENGINE=MyISAM CHARACTER SET=\'utf8\' COLLATE=\'utf8_general_ci\' COMMENT=\' Registro de modulos\';

CREATE TABLE `modules_dependency`
(
    `moduleName` VARCHAR(50) NOT NULL COMMENT \'Modulo\',
    `dependence` VARCHAR(50) NOT NULL COMMENT \'Modulos de los cuales depende\',
    PRIMARY KEY (`moduleName`,`dependence`),
    CONSTRAINT `modules_dependency_FK_1`
        FOREIGN KEY (`moduleName`)
        REFERENCES `modules_module` (`name`)
        ON DELETE CASCADE
) ENGINE=MyISAM CHARACTER SET=\'utf8\' COLLATE=\'utf8_general_ci\' COMMENT=\'Dependencia de modulos \';

CREATE TABLE `modules_label`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT COMMENT \'Id module label\',
    `name` VARCHAR(255) NOT NULL COMMENT \'nombre del modulo\',
    `label` VARCHAR(255) COMMENT \'Etiqueta\',
    `description` VARCHAR(255) COMMENT \'Descripcion del modulo\',
    `language` VARCHAR(100) COMMENT \'idioma de la etiqueta\',
    PRIMARY KEY (`id`,`name`),
    INDEX `modules_label_FI_1` (`name`),
    CONSTRAINT `modules_label_FK_1`
        FOREIGN KEY (`name`)
        REFERENCES `modules_module` (`name`)
        ON DELETE CASCADE
) ENGINE=MyISAM CHARACTER SET=\'utf8\' COLLATE=\'utf8_general_ci\' COMMENT=\'Etiquetas de modulos \';

CREATE TABLE `modules_entity`
(
    `moduleName` VARCHAR(50) NOT NULL COMMENT \'nombre del modulo\',
    `name` VARCHAR(50) NOT NULL COMMENT \'Nombre de la entidad\',
    `phpName` VARCHAR(50) COMMENT \'Nombre de la Clase\',
    `description` VARCHAR(255) COMMENT \'Descripcion de la entidad\',
    `softDelete` BOOL COMMENT \'Indica si usa softdelete\',
    `relation` BOOL COMMENT \'Indica si es una entidad principal o una relacion de dos entidades\',
    `saveLog` BOOL COMMENT \'Indica si guarda log de cambios\',
    `nestedset` BOOL COMMENT \'Indica si es una entidad nestedset\',
    `scopeFieldUniqueName` VARCHAR(100) COMMENT \'Indica el campo que es usado como scope en el nestedset\',
    `behaviors` LONGBLOB COMMENT \'Indica los behaviors que tiene la entidad\',
    PRIMARY KEY (`name`),
    INDEX `modules_entity_FI_1` (`moduleName`),
    INDEX `modules_entity_FI_2` (`scopeFieldUniqueName`),
    CONSTRAINT `modules_entity_FK_1`
        FOREIGN KEY (`moduleName`)
        REFERENCES `modules_module` (`name`),
    CONSTRAINT `modules_entity_FK_2`
        FOREIGN KEY (`scopeFieldUniqueName`)
        REFERENCES `modules_entityField` (`uniqueName`)
) ENGINE=MyISAM CHARACTER SET=\'utf8\' COLLATE=\'utf8_general_ci\' COMMENT=\'Entidades de modulos \';

CREATE TABLE `modules_entityField`
(
    `uniqueName` VARCHAR(100) NOT NULL COMMENT \'Nombre unico del campo\',
    `entityName` VARCHAR(50) NOT NULL COMMENT \'Nombre de la entidad\',
    `name` VARCHAR(50) NOT NULL COMMENT \'Nombre del campo (max 50 caracteres)\',
    `description` VARCHAR(255) COMMENT \'Descripcion del campo (comment)\',
    `isRequired` BOOL COMMENT \'Indica si es obligatorio\',
    `defaultValue` VARCHAR(255) COMMENT \'Valor por defecto\',
    `isPrimaryKey` BOOL COMMENT \'Indica si clave primaria\',
    `isAutoIncrement` BOOL COMMENT \'Indica si el campo es autoincremental\',
    `order` INTEGER NOT NULL COMMENT \'Orden\',
    `type` INTEGER NOT NULL COMMENT \'Tipo de campo\',
    `unique` BOOL COMMENT \'Indica si es unica\',
    `size` INTEGER COMMENT \'Size del campo\',
    `aggregateExpression` VARCHAR(255) COMMENT \'Detalles de la expresion agregada\',
    `label` VARCHAR(255) COMMENT \'Etiqueta para el formulario\',
    `formFieldType` INTEGER COMMENT \'Tipo de campo para formulario\',
    `formFieldSize` INTEGER COMMENT \'Size del campo en formulario\',
    `formFieldLines` INTEGER COMMENT \'Size del campo en formulario lineas\',
    `formFieldUseCalendar` BOOL COMMENT \'Si utiliza o no el calendario en formulario\',
    `foreignKeyTable` VARCHAR(50) COMMENT \'Entidad con la que enlaza la clave remota\',
    `foreignKeyRemote` VARCHAR(100) COMMENT \'Nombre del campo en la tabla remota\',
    `onDelete` VARCHAR(30) COMMENT \'Comportamiento onDelete\',
    `automatic` BOOL COMMENT \'Indica si es una columna autogenerada por un behavior\',
    PRIMARY KEY (`uniqueName`),
    INDEX `modules_entityField_FI_1` (`entityName`),
    INDEX `modules_entityField_FI_2` (`foreignKeyTable`),
    INDEX `modules_entityField_FI_3` (`foreignKeyRemote`),
    CONSTRAINT `modules_entityField_FK_1`
        FOREIGN KEY (`entityName`)
        REFERENCES `modules_entity` (`name`)
        ON DELETE CASCADE,
    CONSTRAINT `modules_entityField_FK_2`
        FOREIGN KEY (`foreignKeyTable`)
        REFERENCES `modules_entity` (`name`)
        ON DELETE SET NULL,
    CONSTRAINT `modules_entityField_FK_3`
        FOREIGN KEY (`foreignKeyRemote`)
        REFERENCES `modules_entityField` (`uniqueName`)
        ON DELETE SET NULL
) ENGINE=MyISAM CHARACTER SET=\'utf8\' COLLATE=\'utf8_general_ci\' COMMENT=\'Campos de las entidades de modulos\';

CREATE TABLE `modules_entityFieldValidation`
(
    `entityFieldUniqueName` VARCHAR(100) NOT NULL COMMENT \'Nombre unico del campo\',
    `name` VARCHAR(50) NOT NULL COMMENT \'Nombre del validador\',
    `value` VARCHAR(50) COMMENT \'Valor del validador\',
    `message` VARCHAR(255) COMMENT \'Mensaje\',
    PRIMARY KEY (`entityFieldUniqueName`,`name`),
    CONSTRAINT `modules_entityFieldValidation_FK_1`
        FOREIGN KEY (`entityFieldUniqueName`)
        REFERENCES `modules_entityField` (`uniqueName`)
        ON DELETE CASCADE
) ENGINE=MyISAM COMMENT=\'Validaciones de los campos de las entidades de modulos \';

CREATE TABLE `requirements_requirement`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT COMMENT \'Headline Id\',
    `name` VARCHAR(255) NOT NULL COMMENT \'Headline\',
    `description` MEDIUMTEXT COMMENT \'Descripcion del proceso\',
    `output` MEDIUMTEXT COMMENT \'Descripcion del resultado\',
    `input` MEDIUMTEXT COMMENT \'Descripcion del ingreso de datos\',
    `process` MEDIUMTEXT COMMENT \'Descripcion del ingreso de datos\',
    `other` MEDIUMTEXT COMMENT \'Otras informaciones\',
    `estimatedDelivery` DATETIME COMMENT \'Fecha estimada de entrega\',
    `realDelivery` DATETIME COMMENT \'Fecha de Entrega\',
    `delivered` BOOL DEFAULT 0 COMMENT \'entregada\',
    `developmentId` INTEGER COMMENT \'Id del desarrollo\',
    `clientId` INTEGER COMMENT \'Id del cliente\',
    `estimatedHours` FLOAT COMMENT \'Estimacion de horas\',
    `estimatedCost` FLOAT COMMENT \'Estimacion de costos\',
    `realHours` FLOAT COMMENT \'Horas insumidas realmente\',
    `realCost` FLOAT COMMENT \'Costos reales\',
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
) ENGINE=MyISAM CHARACTER SET=\'utf8\' COLLATE=\'utf8_general_ci\' COMMENT=\'Requerimientos\';

CREATE TABLE `requirements_development`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT COMMENT \'Development Id\',
    `name` VARCHAR(255) NOT NULL COMMENT \'Headline\',
    `description` MEDIUMTEXT COMMENT \'Descripcion del proceso\',
    `output` MEDIUMTEXT COMMENT \'Descripcion del resultado\',
    `input` MEDIUMTEXT COMMENT \'Descripcion del ingreso de datos\',
    `process` MEDIUMTEXT COMMENT \'Descripcion del ingreso de datos\',
    `other` MEDIUMTEXT COMMENT \'Otras informaciones\',
    `estimatedDelivery` DATETIME COMMENT \'Fecha estimada de entrega\',
    `realDelivery` DATETIME COMMENT \'Fecha de Entrega\',
    `delivered` BOOL DEFAULT 0 COMMENT \'entregada\',
    `clientId` INTEGER COMMENT \'Id del cliente\',
    `estimatedHours` FLOAT COMMENT \'Estimacion de horas\',
    `estimatedCost` FLOAT COMMENT \'Estimacion de costos\',
    `realHours` FLOAT COMMENT \'Horas insumidas realmente\',
    `realCost` FLOAT COMMENT \'Costos reales\',
    `quotation` FLOAT COMMENT \'Cotizacion\',
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `requirements_development_FI_1` (`clientId`),
    CONSTRAINT `requirements_development_FK_1`
        FOREIGN KEY (`clientId`)
        REFERENCES `affiliates_affiliate` (`id`)
        ON DELETE CASCADE
) ENGINE=MyISAM CHARACTER SET=\'utf8\' COLLATE=\'utf8_general_ci\' COMMENT=\'Desarrollo\';

CREATE TABLE `resources_resource`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT COMMENT \'Identificacion del recurso\',
    `title` VARCHAR(255) COMMENT \'Titulo\',
    `description` VARCHAR(255) COMMENT \'Descripcion\',
    `path` VARCHAR(255) COMMENT \'URI del recurso\',
    PRIMARY KEY (`id`)
) ENGINE=MyISAM CHARACTER SET=\'utf8\' COLLATE=\'utf8_general_ci\' COMMENT=\'Recursos\';

CREATE TABLE `security_action`
(
    `action` VARCHAR(100) NOT NULL COMMENT \'Action pagina\',
    `module` VARCHAR(100) COMMENT \'Modulo\',
    `section` VARCHAR(100) COMMENT \'Seccion\',
    `access` INTEGER COMMENT \'El acceso a ese action\',
    `accessAffiliateUser` INTEGER COMMENT \'El acceso a ese action para los usuarios por afiliados\',
    `accessRegistrationUser` INTEGER COMMENT \'El acceso a ese action para los usuarios por registracion\',
    `accessClientUser` INTEGER COMMENT \'El acceso a ese action para los usuarios por cliente\',
    `active` INTEGER COMMENT \'Si el action esta activo o no\',
    `pair` VARCHAR(100) COMMENT \'Par del Action\',
    `noCheckLogin` TINYINT(1) DEFAULT 0 COMMENT \'Si no se chequea login ese action\',
    PRIMARY KEY (`action`),
    INDEX `security_action_FI_1` (`module`),
    CONSTRAINT `security_action_FK_1`
        FOREIGN KEY (`module`)
        REFERENCES `security_module` (`module`)
) ENGINE=MyISAM CHARACTER SET=\'utf8\' COLLATE=\'utf8_general_ci\' COMMENT=\'Actions del sistema\';

CREATE TABLE `security_module`
(
    `module` VARCHAR(100) NOT NULL COMMENT \'Modulo\',
    `access` INTEGER COMMENT \'El acceso a ese modulo\',
    `accessAffiliateUser` INTEGER COMMENT \'El acceso a ese modulo para los usuarios por afiliados\',
    `accessRegistrationUser` INTEGER COMMENT \'El acceso a ese modulo para los usuarios por registracion\',
    `accessClientUser` INTEGER COMMENT \'El acceso a ese action para los usuarios por cliente\',
    `noCheckLogin` TINYINT(1) DEFAULT 0 COMMENT \'Si no se chequea login ese modulo\',
    PRIMARY KEY (`module`)
) ENGINE=MyISAM CHARACTER SET=\'utf8\' COLLATE=\'utf8_general_ci\' COMMENT=\'Modulos del sistema\';

CREATE TABLE `security_actionLabel`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT COMMENT \'Id label security\',
    `action` VARCHAR(100) NOT NULL COMMENT \'Action pagina\',
    `language` VARCHAR(100) COMMENT \'Idioma de la etiqueta\',
    `label` VARCHAR(100) COMMENT \'Etiqueta\',
    `description` VARCHAR(255) COMMENT \'Descripcion\',
    PRIMARY KEY (`id`,`action`)
) ENGINE=MyISAM CHARACTER SET=\'utf8\' COLLATE=\'utf8_general_ci\' COMMENT=\'etiquetas de actions de seguridad\';

CREATE TABLE `services_alertSubscription`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) COMMENT \'Nombre de la suscripcion\',
    `entityName` VARCHAR(50) COMMENT \'Nombre unico de la entidad asociada.\',
    `entityDateFieldUniqueName` VARCHAR(100) COMMENT \'Nombre unico del campo fecha\',
    `entityBooleanFieldUniqueName` VARCHAR(100) COMMENT \'Nombre unico del campo a evaluar por verdadero o falso.\',
    `anticipationDays` INTEGER COMMENT \'Cantidad de dias de anticipacion. Se usa para evaluar campos tipo fecha.\',
    `entityNameFieldUniqueName` VARCHAR(100) COMMENT \'Campo a imprimir en representacion del nombre de cada instancia de la entidad\',
    `extraRecipients` TEXT COMMENT \'Destinatarios extra\',
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
) ENGINE=MyISAM CHARACTER SET=\'utf8\' COLLATE=\'utf8_general_ci\' COMMENT=\'Suscripciones de alerta\';

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
) ENGINE=MyISAM CHARACTER SET=\'utf8\' COLLATE=\'utf8_general_ci\' COMMENT=\'Relacion AlertSubscription - User\';

CREATE TABLE `services_scheduleSubscription`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) COMMENT \'Nombre de la suscripcion\',
    `entityName` VARCHAR(50) COMMENT \'Nombre unico de la entidad asociada.\',
    `entityDateFieldUniqueName` VARCHAR(100) COMMENT \'Nombre unico del campo fecha\',
    `entityBooleanFieldUniqueName` VARCHAR(100) COMMENT \'Nombre unico del campo a evaluar por verdadero o falso.\',
    `anticipationDays` INTEGER COMMENT \'Cantidad de dias de anticipacion. Se usa para evaluar campos tipo fecha.\',
    `entityNameFieldUniqueName` VARCHAR(100) COMMENT \'Campo a imprimir en representacion del nombre de cada instancia de la entidad\',
    `extraRecipients` TEXT COMMENT \'Destinatarios extra\',
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
) ENGINE=MyISAM CHARACTER SET=\'utf8\' COLLATE=\'utf8_general_ci\' COMMENT=\'Suscripciones de schedulea\';

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
) ENGINE=MyISAM CHARACTER SET=\'utf8\' COLLATE=\'utf8_general_ci\' COMMENT=\'Relacion ScheduleSubscription - User\';

CREATE TABLE `services_internalMail`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `subject` VARCHAR(255) COMMENT \'Asunto\',
    `body` TEXT COMMENT \'Cuerpo del mensaje\',
    `recipientId` INTEGER COMMENT \'Receptor del mensaje\',
    `recipientType` VARCHAR(50) COMMENT \'Tipo de receptor del mensaje\',
    `readOn` DATETIME COMMENT \'Momento en que el mensaje fue leido\',
    `fromId` INTEGER COMMENT \'Remitente\',
    `fromType` VARCHAR(50) COMMENT \'Tipo de remitente\',
    `to` LONGBLOB COMMENT \'Destinatarios\',
    `replyId` INTEGER COMMENT \'Id del mensaje al que responde\',
    `created_at` DATETIME,
    `updated_at` DATETIME,
    `deleted_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `services_internalMail_FI_1` (`replyId`),
    CONSTRAINT `services_internalMail_FK_1`
        FOREIGN KEY (`replyId`)
        REFERENCES `services_internalMail` (`id`)
) ENGINE=MyISAM CHARACTER SET=\'utf8\' COLLATE=\'utf8_general_ci\' COMMENT=\'Mensajes internos\';

CREATE TABLE `multilang_language`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `code` VARCHAR(30) NOT NULL,
    `locale` VARCHAR(30),
    PRIMARY KEY (`id`)
) ENGINE=MyISAM CHARACTER SET=\'utf8\' COLLATE=\'utf8_general_ci\';

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
) ENGINE=MyISAM CHARACTER SET=\'utf8\' COLLATE=\'utf8_general_ci\';

CREATE TABLE `users_user`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT COMMENT \'User Id\',
    `username` VARCHAR(255) NOT NULL COMMENT \'username\',
    `password` VARCHAR(255) NOT NULL COMMENT \'password\',
    `passwordUpdated` DATE COMMENT \'Fecha de actualizacion de la clave\',
    `name` VARCHAR(90) COMMENT \'Nombre\',
    `surname` VARCHAR(90) COMMENT \'Apellido\',
    `active` TINYINT(1) NOT NULL COMMENT \'Is user active?\',
    `levelId` INTEGER COMMENT \'User Level\',
    `lastLogin` DATETIME COMMENT \'Fecha del ultimo login del usuario\',
    `timezone` VARCHAR(25) COMMENT \'Timezone GMT del usuario\',
    `recoveryHash` VARCHAR(255) COMMENT \'Hash enviado para la recuperacion de clave\',
    `recoveryHashCreatedOn` DATETIME COMMENT \'Momento de la solicitud para la recuperacion de clave\',
    `mailAddress` VARCHAR(90) COMMENT \'Direccion electronica\',
    `mailAddressAlt` VARCHAR(90) COMMENT \'Direccion electronica alternativa\',
    `session` VARCHAR(90) COMMENT \'Nombre de la sesion\',
    `deleted_at` DATETIME,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `users_user_U_1` (`username`),
    INDEX `users_user_FI_1` (`levelId`),
    CONSTRAINT `users_user_FK_1`
        FOREIGN KEY (`levelId`)
        REFERENCES `users_level` (`id`)
) ENGINE=MyISAM CHARACTER SET=\'utf8\' COLLATE=\'utf8_general_ci\' COMMENT=\'Users\';

CREATE TABLE `users_group`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT COMMENT \'Group ID\',
    `name` VARCHAR(255) NOT NULL COMMENT \'Group Name\',
    `created` DATETIME NOT NULL COMMENT \'Creation date for\',
    `updated` DATETIME NOT NULL COMMENT \'Last update date\',
    `bitLevel` INTEGER COMMENT \'Nivel\',
    PRIMARY KEY (`id`),
    UNIQUE INDEX `users_group_U_1` (`name`)
) ENGINE=MyISAM CHARACTER SET=\'utf8\' COLLATE=\'utf8_general_ci\' COMMENT=\'Groups\';

CREATE TABLE `users_userGroup`
(
    `userId` INTEGER NOT NULL COMMENT \'Group ID\',
    `groupId` INTEGER NOT NULL COMMENT \'Group ID\',
    PRIMARY KEY (`userId`,`groupId`),
    INDEX `users_userGroup_FI_2` (`groupId`),
    CONSTRAINT `users_userGroup_FK_1`
        FOREIGN KEY (`userId`)
        REFERENCES `users_user` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `users_userGroup_FK_2`
        FOREIGN KEY (`groupId`)
        REFERENCES `users_group` (`id`)
        ON DELETE CASCADE
) ENGINE=MyISAM COMMENT=\'Users / Groups\';

CREATE TABLE `users_level`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT COMMENT \'Level ID\',
    `name` VARCHAR(255) NOT NULL COMMENT \'Level Name\',
    `bitLevel` INTEGER COMMENT \'Bit del nivel\',
    PRIMARY KEY (`id`),
    UNIQUE INDEX `users_level_U_1` (`name`)
) ENGINE=MyISAM CHARACTER SET=\'utf8\' COLLATE=\'utf8_general_ci\' COMMENT=\'Levels\';

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'application' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `affiliates_affiliate`;

DROP TABLE IF EXISTS `affiliates_user`;

DROP TABLE IF EXISTS `affiliates_level`;

DROP TABLE IF EXISTS `affiliates_userGroup`;

DROP TABLE IF EXISTS `affiliates_group`;

DROP TABLE IF EXISTS `affiliates_branch`;

DROP TABLE IF EXISTS `categories_category`;

DROP TABLE IF EXISTS `users_groupCategory`;

DROP TABLE IF EXISTS `actionLogs_log`;

DROP TABLE IF EXISTS `actionLogs_label`;

DROP TABLE IF EXISTS `common_menuItem`;

DROP TABLE IF EXISTS `common_menuItemInfo`;

DROP TABLE IF EXISTS `modules_module`;

DROP TABLE IF EXISTS `modules_dependency`;

DROP TABLE IF EXISTS `modules_label`;

DROP TABLE IF EXISTS `modules_entity`;

DROP TABLE IF EXISTS `modules_entityField`;

DROP TABLE IF EXISTS `modules_entityFieldValidation`;

DROP TABLE IF EXISTS `requirements_requirement`;

DROP TABLE IF EXISTS `requirements_development`;

DROP TABLE IF EXISTS `resources_resource`;

DROP TABLE IF EXISTS `security_action`;

DROP TABLE IF EXISTS `security_module`;

DROP TABLE IF EXISTS `security_actionLabel`;

DROP TABLE IF EXISTS `services_alertSubscription`;

DROP TABLE IF EXISTS `services_alertSubscriptionUser`;

DROP TABLE IF EXISTS `services_scheduleSubscription`;

DROP TABLE IF EXISTS `services_scheduleSubscriptionUser`;

DROP TABLE IF EXISTS `services_internalMail`;

DROP TABLE IF EXISTS `multilang_language`;

DROP TABLE IF EXISTS `multilang_text`;

DROP TABLE IF EXISTS `users_user`;

DROP TABLE IF EXISTS `users_group`;

DROP TABLE IF EXISTS `users_userGroup`;

DROP TABLE IF EXISTS `users_level`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}