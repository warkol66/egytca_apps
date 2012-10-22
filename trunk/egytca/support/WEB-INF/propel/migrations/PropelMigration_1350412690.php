<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1350412690.
 * Generated on 2012-10-16 15:38:10 by sol
 */
class PropelMigration_1350412690
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

ALTER TABLE `actionLogs_log` ADD CONSTRAINT `actionLogs_log_FK_1`
    FOREIGN KEY (`action`)
    REFERENCES `security_action` (`action`);

ALTER TABLE `affiliates_affiliate` ADD CONSTRAINT `affiliates_affiliate_FK_1`
    FOREIGN KEY (`ownerId`)
    REFERENCES `affiliates_user` (`id`);

ALTER TABLE `affiliates_branch` ADD CONSTRAINT `affiliates_branch_FK_1`
    FOREIGN KEY (`affiliateId`)
    REFERENCES `affiliates_affiliate` (`id`);

ALTER TABLE `affiliates_user` ADD CONSTRAINT `affiliates_user_FK_1`
    FOREIGN KEY (`levelId`)
    REFERENCES `affiliates_level` (`id`);

ALTER TABLE `affiliates_user` ADD CONSTRAINT `affiliates_user_FK_2`
    FOREIGN KEY (`affiliateId`)
    REFERENCES `affiliates_affiliate` (`id`);

ALTER TABLE `affiliates_userGroup` ADD CONSTRAINT `affiliates_userGroup_FK_1`
    FOREIGN KEY (`userId`)
    REFERENCES `affiliates_user` (`id`);

ALTER TABLE `affiliates_userGroup` ADD CONSTRAINT `affiliates_userGroup_FK_2`
    FOREIGN KEY (`groupId`)
    REFERENCES `affiliates_group` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `categories_category` CHANGE `isPublic` `isPublic` TINYINT(1) DEFAULT 0 NOT NULL COMMENT \'Is category public?\';

ALTER TABLE `common_menuItem` CHANGE `newWindow` `newWindow` BOOL DEFAULT 0 NOT NULL COMMENT \'Abrir el enlace en nueva ventana\';

ALTER TABLE `common_menuItemInfo` ADD CONSTRAINT `common_menuItemInfo_FK_1`
    FOREIGN KEY (`menuItemId`)
    REFERENCES `common_menuItem` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `modules_dependency` ADD CONSTRAINT `modules_dependency_FK_1`
    FOREIGN KEY (`moduleName`)
    REFERENCES `modules_module` (`name`)
    ON DELETE CASCADE;

ALTER TABLE `modules_entity` CHANGE `softDelete` `softDelete` BOOL COMMENT \'Indica si usa softdelete\';

ALTER TABLE `modules_entity` CHANGE `relation` `relation` BOOL COMMENT \'Indica si es una entidad principal o una relacion de dos entidades\';

ALTER TABLE `modules_entity` CHANGE `saveLog` `saveLog` BOOL COMMENT \'Indica si guarda log de cambios\';

ALTER TABLE `modules_entity` CHANGE `nestedset` `nestedset` BOOL COMMENT \'Indica si es una entidad nestedset\';

ALTER TABLE `modules_entity` ADD CONSTRAINT `modules_entity_FK_1`
    FOREIGN KEY (`moduleName`)
    REFERENCES `modules_module` (`name`);

ALTER TABLE `modules_entity` ADD CONSTRAINT `modules_entity_FK_2`
    FOREIGN KEY (`scopeFieldUniqueName`)
    REFERENCES `modules_entityField` (`uniqueName`);

ALTER TABLE `modules_entityField` CHANGE `isRequired` `isRequired` BOOL COMMENT \'Indica si es obligatorio\';

ALTER TABLE `modules_entityField` CHANGE `isPrimaryKey` `isPrimaryKey` BOOL COMMENT \'Indica si clave primaria\';

ALTER TABLE `modules_entityField` CHANGE `isAutoIncrement` `isAutoIncrement` BOOL COMMENT \'Indica si el campo es autoincremental\';

ALTER TABLE `modules_entityField` CHANGE `unique` `unique` BOOL COMMENT \'Indica si es unica\';

ALTER TABLE `modules_entityField` CHANGE `formFieldUseCalendar` `formFieldUseCalendar` BOOL COMMENT \'Si utiliza o no el calendario en formulario\';

ALTER TABLE `modules_entityField` CHANGE `automatic` `automatic` BOOL COMMENT \'Indica si es una columna autogenerada por un behavior\';

ALTER TABLE `modules_entityField` ADD CONSTRAINT `modules_entityField_FK_1`
    FOREIGN KEY (`entityName`)
    REFERENCES `modules_entity` (`name`)
    ON DELETE CASCADE;

ALTER TABLE `modules_entityField` ADD CONSTRAINT `modules_entityField_FK_2`
    FOREIGN KEY (`foreignKeyTable`)
    REFERENCES `modules_entity` (`name`)
    ON DELETE SET NULL;

ALTER TABLE `modules_entityField` ADD CONSTRAINT `modules_entityField_FK_3`
    FOREIGN KEY (`foreignKeyRemote`)
    REFERENCES `modules_entityField` (`uniqueName`)
    ON DELETE SET NULL;

ALTER TABLE `modules_entityFieldValidation` ADD CONSTRAINT `modules_entityFieldValidation_FK_1`
    FOREIGN KEY (`entityFieldUniqueName`)
    REFERENCES `modules_entityField` (`uniqueName`)
    ON DELETE CASCADE;

ALTER TABLE `modules_label` ADD CONSTRAINT `modules_label_FK_1`
    FOREIGN KEY (`name`)
    REFERENCES `modules_module` (`name`)
    ON DELETE CASCADE;

ALTER TABLE `modules_module` CHANGE `active` `active` TINYINT(1) DEFAULT 0 NOT NULL COMMENT \'Estado del modulo\';

ALTER TABLE `modules_module` CHANGE `alwaysActive` `alwaysActive` TINYINT(1) DEFAULT 0 NOT NULL COMMENT \'Modulo siempre activo\';

ALTER TABLE `modules_module` CHANGE `hasCategories` `hasCategories` TINYINT(1) DEFAULT 0 NOT NULL COMMENT \'El Modulo tiene categorias relacionadas?\';

ALTER TABLE `multilang_text` ADD CONSTRAINT `multilang_text_FK_1`
    FOREIGN KEY (`languageCode`)
    REFERENCES `multilang_language` (`code`)
    ON DELETE CASCADE;

ALTER TABLE `multilang_text` ADD CONSTRAINT `multilang_text_FK_2`
    FOREIGN KEY (`moduleName`)
    REFERENCES `modules_module` (`name`);

ALTER TABLE `requirements_development` CHANGE `description` `description` MEDIUMTEXT COMMENT \'Descripcion del proceso\';

ALTER TABLE `requirements_development` CHANGE `output` `output` MEDIUMTEXT COMMENT \'Descripcion del resultado\';

ALTER TABLE `requirements_development` CHANGE `input` `input` MEDIUMTEXT COMMENT \'Descripcion del ingreso de datos\';

ALTER TABLE `requirements_development` CHANGE `process` `process` MEDIUMTEXT COMMENT \'Descripcion del ingreso de datos\';

ALTER TABLE `requirements_development` CHANGE `other` `other` MEDIUMTEXT COMMENT \'Otras informaciones\';

ALTER TABLE `requirements_development` CHANGE `delivered` `delivered` BOOL DEFAULT 0 COMMENT \'entregada\';

ALTER TABLE `requirements_development` CHANGE `estimatedHours` `estimatedHours` FLOAT COMMENT \'Estimacion de horas\';

ALTER TABLE `requirements_development` CHANGE `estimatedCost` `estimatedCost` FLOAT COMMENT \'Estimacion de costos\';

ALTER TABLE `requirements_development` CHANGE `realHours` `realHours` FLOAT COMMENT \'Horas insumidas realmente\';

ALTER TABLE `requirements_development` CHANGE `realCost` `realCost` FLOAT COMMENT \'Costos reales\';

ALTER TABLE `requirements_development` CHANGE `quotation` `quotation` FLOAT COMMENT \'Cotizacion\';

ALTER TABLE `requirements_development` ADD CONSTRAINT `requirements_development_FK_1`
    FOREIGN KEY (`clientId`)
    REFERENCES `affiliates_affiliate` (`id`)
    ON DELETE CASCADE;

DROP INDEX `requirements_development_resource_FI_1` ON `requirements_development_resource`;

ALTER TABLE `requirements_development_resource` CHANGE `requirementId` `developmentId` INTEGER NOT NULL COMMENT \'Id del desarrollo\';

CREATE INDEX `requirements_development_resource_FI_1` ON `requirements_development_resource` (`developmentId`);

ALTER TABLE `requirements_development_resource` ADD CONSTRAINT `requirements_development_resource_FK_1`
    FOREIGN KEY (`developmentId`)
    REFERENCES `requirements_development` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `requirements_development_resource` ADD CONSTRAINT `requirements_development_resource_FK_2`
    FOREIGN KEY (`resourceId`)
    REFERENCES `resources_resource` (`id`);

ALTER TABLE `requirements_requirement` CHANGE `description` `description` MEDIUMTEXT COMMENT \'Descripcion del proceso\';

ALTER TABLE `requirements_requirement` CHANGE `output` `output` MEDIUMTEXT COMMENT \'Descripcion del resultado\';

ALTER TABLE `requirements_requirement` CHANGE `input` `input` MEDIUMTEXT COMMENT \'Descripcion del ingreso de datos\';

ALTER TABLE `requirements_requirement` CHANGE `process` `process` MEDIUMTEXT COMMENT \'Descripcion del ingreso de datos\';

ALTER TABLE `requirements_requirement` CHANGE `other` `other` MEDIUMTEXT COMMENT \'Otras informaciones\';

ALTER TABLE `requirements_requirement` CHANGE `delivered` `delivered` BOOL DEFAULT 0 COMMENT \'entregada\';

ALTER TABLE `requirements_requirement` CHANGE `estimatedHours` `estimatedHours` FLOAT COMMENT \'Estimacion de horas\';

ALTER TABLE `requirements_requirement` CHANGE `estimatedCost` `estimatedCost` FLOAT COMMENT \'Estimacion de costos\';

ALTER TABLE `requirements_requirement` CHANGE `realHours` `realHours` FLOAT COMMENT \'Horas insumidas realmente\';

ALTER TABLE `requirements_requirement` CHANGE `realCost` `realCost` FLOAT COMMENT \'Costos reales\';

ALTER TABLE `requirements_requirement` ADD CONSTRAINT `requirements_requirement_FK_1`
    FOREIGN KEY (`developmentId`)
    REFERENCES `requirements_development` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `requirements_requirement` ADD CONSTRAINT `requirements_requirement_FK_2`
    FOREIGN KEY (`clientId`)
    REFERENCES `affiliates_affiliate` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `requirements_requirement_resource` ADD CONSTRAINT `requirements_requirement_resource_FK_1`
    FOREIGN KEY (`requirementId`)
    REFERENCES `requirements_requirement` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `requirements_requirement_resource` ADD CONSTRAINT `requirements_requirement_resource_FK_2`
    FOREIGN KEY (`resourceId`)
    REFERENCES `resources_resource` (`id`);

ALTER TABLE `security_action` ADD CONSTRAINT `security_action_FK_1`
    FOREIGN KEY (`module`)
    REFERENCES `security_module` (`module`);

ALTER TABLE `services_alertSubscription` ADD CONSTRAINT `services_alertSubscription_FK_1`
    FOREIGN KEY (`entityName`)
    REFERENCES `modules_entity` (`name`)
    ON DELETE CASCADE;

ALTER TABLE `services_alertSubscription` ADD CONSTRAINT `services_alertSubscription_FK_2`
    FOREIGN KEY (`entityNameFieldUniqueName`)
    REFERENCES `modules_entityField` (`uniqueName`)
    ON DELETE CASCADE;

ALTER TABLE `services_alertSubscription` ADD CONSTRAINT `services_alertSubscription_FK_3`
    FOREIGN KEY (`entityDateFieldUniqueName`)
    REFERENCES `modules_entityField` (`uniqueName`)
    ON DELETE CASCADE;

ALTER TABLE `services_alertSubscription` ADD CONSTRAINT `services_alertSubscription_FK_4`
    FOREIGN KEY (`entityBooleanFieldUniqueName`)
    REFERENCES `modules_entityField` (`uniqueName`)
    ON DELETE CASCADE;

ALTER TABLE `services_alertSubscriptionUser` ADD CONSTRAINT `services_alertSubscriptionUser_FK_1`
    FOREIGN KEY (`alertSubscriptionId`)
    REFERENCES `services_alertSubscription` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `services_alertSubscriptionUser` ADD CONSTRAINT `services_alertSubscriptionUser_FK_2`
    FOREIGN KEY (`userId`)
    REFERENCES `users_user` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `services_internalMail` ADD CONSTRAINT `services_internalMail_FK_1`
    FOREIGN KEY (`replyId`)
    REFERENCES `services_internalMail` (`id`);

ALTER TABLE `services_scheduleSubscription` ADD CONSTRAINT `services_scheduleSubscription_FK_1`
    FOREIGN KEY (`entityName`)
    REFERENCES `modules_entity` (`name`)
    ON DELETE CASCADE;

ALTER TABLE `services_scheduleSubscription` ADD CONSTRAINT `services_scheduleSubscription_FK_2`
    FOREIGN KEY (`entityNameFieldUniqueName`)
    REFERENCES `modules_entityField` (`uniqueName`)
    ON DELETE CASCADE;

ALTER TABLE `services_scheduleSubscription` ADD CONSTRAINT `services_scheduleSubscription_FK_3`
    FOREIGN KEY (`entityDateFieldUniqueName`)
    REFERENCES `modules_entityField` (`uniqueName`)
    ON DELETE CASCADE;

ALTER TABLE `services_scheduleSubscription` ADD CONSTRAINT `services_scheduleSubscription_FK_4`
    FOREIGN KEY (`entityBooleanFieldUniqueName`)
    REFERENCES `modules_entityField` (`uniqueName`)
    ON DELETE CASCADE;

ALTER TABLE `services_scheduleSubscriptionUser` ADD CONSTRAINT `services_scheduleSubscriptionUser_FK_1`
    FOREIGN KEY (`scheduleSubscriptionId`)
    REFERENCES `services_scheduleSubscription` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `services_scheduleSubscriptionUser` ADD CONSTRAINT `services_scheduleSubscriptionUser_FK_2`
    FOREIGN KEY (`userId`)
    REFERENCES `users_user` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `users_groupCategory` ADD CONSTRAINT `users_groupCategory_FK_1`
    FOREIGN KEY (`groupId`)
    REFERENCES `users_group` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `users_groupCategory` ADD CONSTRAINT `users_groupCategory_FK_2`
    FOREIGN KEY (`categoryId`)
    REFERENCES `categories_category` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `users_user` ADD CONSTRAINT `users_user_FK_1`
    FOREIGN KEY (`levelId`)
    REFERENCES `users_level` (`id`);

ALTER TABLE `users_userGroup` ADD CONSTRAINT `users_userGroup_FK_1`
    FOREIGN KEY (`userId`)
    REFERENCES `users_user` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `users_userGroup` ADD CONSTRAINT `users_userGroup_FK_2`
    FOREIGN KEY (`groupId`)
    REFERENCES `users_group` (`id`)
    ON DELETE CASCADE;

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

ALTER TABLE `actionLogs_log` DROP FOREIGN KEY `actionLogs_log_FK_1`;

ALTER TABLE `affiliates_affiliate` DROP FOREIGN KEY `affiliates_affiliate_FK_1`;

ALTER TABLE `affiliates_branch` DROP FOREIGN KEY `affiliates_branch_FK_1`;

ALTER TABLE `affiliates_user` DROP FOREIGN KEY `affiliates_user_FK_1`;

ALTER TABLE `affiliates_user` DROP FOREIGN KEY `affiliates_user_FK_2`;

ALTER TABLE `affiliates_userGroup` DROP FOREIGN KEY `affiliates_userGroup_FK_1`;

ALTER TABLE `affiliates_userGroup` DROP FOREIGN KEY `affiliates_userGroup_FK_2`;

ALTER TABLE `categories_category` CHANGE `isPublic` `isPublic` TINYINT(1) DEFAULT 0 NOT NULL;

ALTER TABLE `common_menuItem` CHANGE `newWindow` `newWindow` TINYINT(1) DEFAULT 0 NOT NULL;

ALTER TABLE `common_menuItemInfo` DROP FOREIGN KEY `common_menuItemInfo_FK_1`;

ALTER TABLE `modules_dependency` DROP FOREIGN KEY `modules_dependency_FK_1`;

ALTER TABLE `modules_entity` DROP FOREIGN KEY `modules_entity_FK_1`;

ALTER TABLE `modules_entity` DROP FOREIGN KEY `modules_entity_FK_2`;

ALTER TABLE `modules_entity` CHANGE `softDelete` `softDelete` TINYINT(1);

ALTER TABLE `modules_entity` CHANGE `relation` `relation` TINYINT(1);

ALTER TABLE `modules_entity` CHANGE `saveLog` `saveLog` TINYINT(1);

ALTER TABLE `modules_entity` CHANGE `nestedset` `nestedset` TINYINT(1);

ALTER TABLE `modules_entityField` DROP FOREIGN KEY `modules_entityField_FK_1`;

ALTER TABLE `modules_entityField` DROP FOREIGN KEY `modules_entityField_FK_2`;

ALTER TABLE `modules_entityField` DROP FOREIGN KEY `modules_entityField_FK_3`;

ALTER TABLE `modules_entityField` CHANGE `isRequired` `isRequired` TINYINT(1);

ALTER TABLE `modules_entityField` CHANGE `isPrimaryKey` `isPrimaryKey` TINYINT(1);

ALTER TABLE `modules_entityField` CHANGE `isAutoIncrement` `isAutoIncrement` TINYINT(1);

ALTER TABLE `modules_entityField` CHANGE `unique` `unique` TINYINT(1);

ALTER TABLE `modules_entityField` CHANGE `formFieldUseCalendar` `formFieldUseCalendar` TINYINT(1);

ALTER TABLE `modules_entityField` CHANGE `automatic` `automatic` TINYINT(1);

ALTER TABLE `modules_entityFieldValidation` DROP FOREIGN KEY `modules_entityFieldValidation_FK_1`;

ALTER TABLE `modules_label` DROP FOREIGN KEY `modules_label_FK_1`;

ALTER TABLE `modules_module` CHANGE `active` `active` TINYINT(1) DEFAULT 0 NOT NULL;

ALTER TABLE `modules_module` CHANGE `alwaysActive` `alwaysActive` TINYINT(1) DEFAULT 0 NOT NULL;

ALTER TABLE `modules_module` CHANGE `hasCategories` `hasCategories` TINYINT(1) DEFAULT 0 NOT NULL;

ALTER TABLE `multilang_text` DROP FOREIGN KEY `multilang_text_FK_1`;

ALTER TABLE `multilang_text` DROP FOREIGN KEY `multilang_text_FK_2`;

ALTER TABLE `requirements_development` DROP FOREIGN KEY `requirements_development_FK_1`;

ALTER TABLE `requirements_development` CHANGE `description` `description` TEXT;

ALTER TABLE `requirements_development` CHANGE `output` `output` TEXT;

ALTER TABLE `requirements_development` CHANGE `input` `input` TEXT;

ALTER TABLE `requirements_development` CHANGE `process` `process` TEXT;

ALTER TABLE `requirements_development` CHANGE `other` `other` TEXT;

ALTER TABLE `requirements_development` CHANGE `delivered` `delivered` TINYINT(1) DEFAULT 0;

ALTER TABLE `requirements_development` CHANGE `estimatedHours` `estimatedHours` FLOAT;

ALTER TABLE `requirements_development` CHANGE `estimatedCost` `estimatedCost` FLOAT;

ALTER TABLE `requirements_development` CHANGE `realHours` `realHours` FLOAT;

ALTER TABLE `requirements_development` CHANGE `realCost` `realCost` FLOAT;

ALTER TABLE `requirements_development` CHANGE `quotation` `quotation` FLOAT;

ALTER TABLE `requirements_development_resource` DROP FOREIGN KEY `requirements_development_resource_FK_1`;

ALTER TABLE `requirements_development_resource` DROP FOREIGN KEY `requirements_development_resource_FK_2`;

DROP INDEX `requirements_development_resource_FI_1` ON `requirements_development_resource`;

ALTER TABLE `requirements_development_resource` CHANGE `developmentId` `requirementId` INTEGER NOT NULL;

CREATE INDEX `requirements_development_resource_FI_1` ON `requirements_development_resource` (`requirementId`);

ALTER TABLE `requirements_requirement` DROP FOREIGN KEY `requirements_requirement_FK_1`;

ALTER TABLE `requirements_requirement` DROP FOREIGN KEY `requirements_requirement_FK_2`;

ALTER TABLE `requirements_requirement` CHANGE `description` `description` TEXT;

ALTER TABLE `requirements_requirement` CHANGE `output` `output` TEXT;

ALTER TABLE `requirements_requirement` CHANGE `input` `input` TEXT;

ALTER TABLE `requirements_requirement` CHANGE `process` `process` TEXT;

ALTER TABLE `requirements_requirement` CHANGE `other` `other` TEXT;

ALTER TABLE `requirements_requirement` CHANGE `delivered` `delivered` TINYINT(1) DEFAULT 0;

ALTER TABLE `requirements_requirement` CHANGE `estimatedHours` `estimatedHours` FLOAT;

ALTER TABLE `requirements_requirement` CHANGE `estimatedCost` `estimatedCost` FLOAT;

ALTER TABLE `requirements_requirement` CHANGE `realHours` `realHours` FLOAT;

ALTER TABLE `requirements_requirement` CHANGE `realCost` `realCost` FLOAT;

ALTER TABLE `requirements_requirement_resource` DROP FOREIGN KEY `requirements_requirement_resource_FK_1`;

ALTER TABLE `requirements_requirement_resource` DROP FOREIGN KEY `requirements_requirement_resource_FK_2`;

ALTER TABLE `security_action` DROP FOREIGN KEY `security_action_FK_1`;

ALTER TABLE `services_alertSubscription` DROP FOREIGN KEY `services_alertSubscription_FK_1`;

ALTER TABLE `services_alertSubscription` DROP FOREIGN KEY `services_alertSubscription_FK_2`;

ALTER TABLE `services_alertSubscription` DROP FOREIGN KEY `services_alertSubscription_FK_3`;

ALTER TABLE `services_alertSubscription` DROP FOREIGN KEY `services_alertSubscription_FK_4`;

ALTER TABLE `services_alertSubscriptionUser` DROP FOREIGN KEY `services_alertSubscriptionUser_FK_1`;

ALTER TABLE `services_alertSubscriptionUser` DROP FOREIGN KEY `services_alertSubscriptionUser_FK_2`;

ALTER TABLE `services_internalMail` DROP FOREIGN KEY `services_internalMail_FK_1`;

ALTER TABLE `services_scheduleSubscription` DROP FOREIGN KEY `services_scheduleSubscription_FK_1`;

ALTER TABLE `services_scheduleSubscription` DROP FOREIGN KEY `services_scheduleSubscription_FK_2`;

ALTER TABLE `services_scheduleSubscription` DROP FOREIGN KEY `services_scheduleSubscription_FK_3`;

ALTER TABLE `services_scheduleSubscription` DROP FOREIGN KEY `services_scheduleSubscription_FK_4`;

ALTER TABLE `services_scheduleSubscriptionUser` DROP FOREIGN KEY `services_scheduleSubscriptionUser_FK_1`;

ALTER TABLE `services_scheduleSubscriptionUser` DROP FOREIGN KEY `services_scheduleSubscriptionUser_FK_2`;

ALTER TABLE `users_groupCategory` DROP FOREIGN KEY `users_groupCategory_FK_1`;

ALTER TABLE `users_groupCategory` DROP FOREIGN KEY `users_groupCategory_FK_2`;

ALTER TABLE `users_user` DROP FOREIGN KEY `users_user_FK_1`;

ALTER TABLE `users_userGroup` DROP FOREIGN KEY `users_userGroup_FK_1`;

ALTER TABLE `users_userGroup` DROP FOREIGN KEY `users_userGroup_FK_2`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}