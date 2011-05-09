<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1304950578.
 * Generated on 2011-05-09 11:16:18 
 */
class PropelMigration_1304950578
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

DROP TABLE IF EXISTS `mluse_language`;

DROP TABLE IF EXISTS `mluse_text`;

ALTER TABLE `mer_actor` CHANGE `name` `name` VARCHAR(100) NOT NULL COMMENT \'actor\\\'s name\';

ALTER TABLE `mer_actor` CHANGE `active` `active` BOOL DEFAULT 1 NOT NULL COMMENT \'to be deleted!!!\';

ALTER TABLE `mer_actor` CHANGE `strategy` `strategy` MEDIUMTEXT COMMENT \'Estrategia\';

ALTER TABLE `mer_actor` CHANGE `tactic` `tactic` MEDIUMTEXT COMMENT \'Tactica\';

ALTER TABLE `mer_actor` CHANGE `observations` `observations` MEDIUMTEXT COMMENT \'Observaciones to be deleted\';

ALTER TABLE `MER_actor` ADD
(
	`title` VARCHAR(30) NOT NULL COMMENT \'actor\\\'s title\',
	`surname` VARCHAR(100) NOT NULL COMMENT \'actor\\\'s surname\',
	`comments` MEDIUMTEXT COMMENT \'Comentarios\',
	`deleted_at` DATETIME,
	`created_at` DATETIME,
	`updated_at` DATETIME
);

ALTER TABLE `MER_actor` ADD CONSTRAINT `MER_actor_FK_1`
	FOREIGN KEY (`categoryId`)
	REFERENCES `MER_category` (`id`);

DROP INDEX `MER_ActorActiveQuestion_FI_1` ON `mer_actoractivequestion`;

ALTER TABLE `MER_actorActiveQuestion` ADD CONSTRAINT `MER_actorActiveQuestion_FK_1`
	FOREIGN KEY (`actorId`)
	REFERENCES `MER_actor` (`id`);

ALTER TABLE `MER_actorActiveQuestion` ADD CONSTRAINT `MER_actorActiveQuestion_FK_2`
	FOREIGN KEY (`questionId`)
	REFERENCES `MER_formSectionQuestion` (`id`);

ALTER TABLE `mer_category` CHANGE `active` `active` TINYINT NOT NULL COMMENT \'Is category active?\';

ALTER TABLE `mer_document` CHANGE `type` `categoryId` INTEGER COMMENT \'Numero de tipo de archivo\';

ALTER TABLE `MER_document` ADD
(
	`realFilename` VARCHAR(255) COMMENT \'El nombre real del archivo\',
	`password` VARCHAR(32) COMMENT \'Clave del archivo\',
	`fullTextContent` MEDIUMTEXT COMMENT \'Contenido del archivo\'
);

CREATE INDEX `MER_document_FI_1` ON `MER_document` (`categoryId`);

ALTER TABLE `MER_document` ADD CONSTRAINT `MER_document_FK_1`
	FOREIGN KEY (`categoryId`)
	REFERENCES `MER_category` (`id`)
	ON DELETE CASCADE;

ALTER TABLE `mer_form` CHANGE `relationship` `relationship` TINYINT DEFAULT 0 NOT NULL COMMENT \'Is this form a relationship form (between cities)?\';

ALTER TABLE `MER_form` ADD CONSTRAINT `MER_form_FK_1`
	FOREIGN KEY (`rootSectionId`)
	REFERENCES `MER_formSection` (`id`);

ALTER TABLE `MER_formAnswer` ADD CONSTRAINT `MER_formAnswer_FK_1`
	FOREIGN KEY (`actorId`)
	REFERENCES `MER_actor` (`id`)
	ON DELETE CASCADE;

ALTER TABLE `MER_formAnswer` ADD CONSTRAINT `MER_formAnswer_FK_2`
	FOREIGN KEY (`questionId`)
	REFERENCES `MER_formSectionQuestion` (`id`)
	ON DELETE CASCADE;

ALTER TABLE `MER_formSection` ADD CONSTRAINT `MER_formSection_FK_1`
	FOREIGN KEY (`parentSectionId`)
	REFERENCES `MER_formSection` (`id`)
	ON DELETE CASCADE;

ALTER TABLE `mer_formsectionquestion` CHANGE `analysis` `analysis` TINYINT DEFAULT 0 COMMENT \'Aparece la pregunta en analysis?\';

ALTER TABLE `MER_formSectionQuestion` ADD CONSTRAINT `MER_formSectionQuestion_FK_1`
	FOREIGN KEY (`sectionId`)
	REFERENCES `MER_formSection` (`id`)
	ON DELETE CASCADE;

ALTER TABLE `mer_formsectionquestionoption` CHANGE `defaultOpc` `defaultOpc` TINYINT;

ALTER TABLE `MER_formSectionQuestionOption` ADD CONSTRAINT `MER_formSectionQuestionOption_FK_1`
	FOREIGN KEY (`questionId`)
	REFERENCES `MER_formSectionQuestion` (`id`)
	ON DELETE CASCADE;

ALTER TABLE `MER_graphActor` ADD CONSTRAINT `MER_graphActor_FK_1`
	FOREIGN KEY (`graphId`)
	REFERENCES `MER_graphModel` (`id`)
	ON DELETE CASCADE;

ALTER TABLE `MER_graphActor` ADD CONSTRAINT `MER_graphActor_FK_2`
	FOREIGN KEY (`actorId`)
	REFERENCES `MER_actor` (`id`)
	ON DELETE CASCADE;

ALTER TABLE `MER_graphActor` ADD CONSTRAINT `MER_graphActor_FK_3`
	FOREIGN KEY (`categoryId`)
	REFERENCES `MER_category` (`id`)
	ON DELETE CASCADE;

ALTER TABLE `MER_graphCategory` ADD CONSTRAINT `MER_graphCategory_FK_1`
	FOREIGN KEY (`graphId`)
	REFERENCES `MER_graphModel` (`id`)
	ON DELETE CASCADE;

ALTER TABLE `MER_graphCategory` ADD CONSTRAINT `MER_graphCategory_FK_2`
	FOREIGN KEY (`categoryId`)
	REFERENCES `MER_category` (`id`)
	ON DELETE CASCADE;

ALTER TABLE `mer_graphmodelaxis` CHANGE `axis` `axis` CHAR(1) NOT NULL COMMENT \'Eje\';

ALTER TABLE `MER_graphModelAxis` ADD CONSTRAINT `MER_graphModelAxis_FK_1`
	FOREIGN KEY (`graphId`)
	REFERENCES `MER_graphModel` (`id`)
	ON DELETE CASCADE;

ALTER TABLE `MER_graphModelAxis` ADD CONSTRAINT `MER_graphModelAxis_FK_2`
	FOREIGN KEY (`questionId`)
	REFERENCES `MER_formSectionQuestion` (`id`)
	ON DELETE CASCADE;

ALTER TABLE `MER_graphModelJudgement` ADD CONSTRAINT `MER_graphModelJudgement_FK_1`
	FOREIGN KEY (`graphId`)
	REFERENCES `MER_graphModel` (`id`)
	ON DELETE CASCADE;

ALTER TABLE `MER_graphRelation` ADD CONSTRAINT `MER_graphRelation_FK_1`
	FOREIGN KEY (`actor1Id`)
	REFERENCES `MER_actor` (`id`)
	ON DELETE CASCADE;

ALTER TABLE `MER_graphRelation` ADD CONSTRAINT `MER_graphRelation_FK_2`
	FOREIGN KEY (`actor2Id`)
	REFERENCES `MER_actor` (`id`)
	ON DELETE CASCADE;

ALTER TABLE `MER_graphRelationQuestion` ADD CONSTRAINT `MER_graphRelationQuestion_FK_1`
	FOREIGN KEY (`graphRelationId`)
	REFERENCES `MER_graphRelation` (`id`)
	ON DELETE CASCADE;

ALTER TABLE `MER_graphRelationQuestion` ADD CONSTRAINT `MER_graphRelationQuestion_FK_2`
	FOREIGN KEY (`questionId`)
	REFERENCES `MER_formSectionQuestion` (`id`)
	ON DELETE CASCADE;

ALTER TABLE `MER_hierarchy` ADD CONSTRAINT `MER_hierarchy_FK_1`
	FOREIGN KEY (`actorId`)
	REFERENCES `MER_actor` (`id`);

ALTER TABLE `MER_hierarchy` ADD CONSTRAINT `MER_hierarchy_FK_2`
	FOREIGN KEY (`categoryId`)
	REFERENCES `MER_category` (`id`);

ALTER TABLE `MER_judgementActor` ADD CONSTRAINT `MER_judgementActor_FK_1`
	FOREIGN KEY (`actorId`)
	REFERENCES `MER_actor` (`id`)
	ON DELETE CASCADE;

ALTER TABLE `MER_relationship` ADD CONSTRAINT `MER_relationship_FK_1`
	FOREIGN KEY (`actor1Id`)
	REFERENCES `MER_actor` (`id`);

ALTER TABLE `MER_relationship` ADD CONSTRAINT `MER_relationship_FK_2`
	FOREIGN KEY (`actor2Id`)
	REFERENCES `MER_actor` (`id`);

ALTER TABLE `MER_relationship` ADD CONSTRAINT `MER_relationship_FK_3`
	FOREIGN KEY (`questionId`)
	REFERENCES `MER_formSectionQuestion` (`id`);

ALTER TABLE `MER_relationshipActiveQuestion` ADD CONSTRAINT `MER_relationshipActiveQuestion_FK_1`
	FOREIGN KEY (`actor1Id`)
	REFERENCES `MER_actor` (`id`);

ALTER TABLE `MER_relationshipActiveQuestion` ADD CONSTRAINT `MER_relationshipActiveQuestion_FK_2`
	FOREIGN KEY (`actor2Id`)
	REFERENCES `MER_actor` (`id`);

ALTER TABLE `MER_relationshipActiveQuestion` ADD CONSTRAINT `MER_relationshipActiveQuestion_FK_3`
	FOREIGN KEY (`questionId`)
	REFERENCES `MER_formSectionQuestion` (`id`);

ALTER TABLE `multilang_text` ADD CONSTRAINT `multilang_text_FK_1`
	FOREIGN KEY (`languageCode`)
	REFERENCES `multilang_language` (`code`)
	ON DELETE CASCADE;

ALTER TABLE `multilang_text` ADD CONSTRAINT `multilang_text_FK_2`
	FOREIGN KEY (`moduleName`)
	REFERENCES `modules_module` (`name`);

ALTER TABLE `securityaction` DROP `pair`;

ALTER TABLE `users_group` DROP `bitLevel`;

ALTER TABLE `users_groupCategory` ADD CONSTRAINT `users_groupCategory_FK_1`
	FOREIGN KEY (`groupId`)
	REFERENCES `users_group` (`id`)
	ON DELETE CASCADE;

ALTER TABLE `users_groupCategory` ADD CONSTRAINT `users_groupCategory_FK_2`
	FOREIGN KEY (`categoryId`)
	REFERENCES `MER_category` (`id`);

ALTER TABLE `users_user` CHANGE `active` `active` TINYINT NOT NULL COMMENT \'Is user active?\';

ALTER TABLE `users_user` CHANGE `levelid` `levelId` INTEGER COMMENT \'User Level\';

CREATE INDEX `users_user_FI_1` ON `users_user` (`levelId`);

ALTER TABLE `users_user` ADD CONSTRAINT `users_user_FK_1`
	FOREIGN KEY (`levelId`)
	REFERENCES `users_level` (`id`);

ALTER TABLE `users_userGroup` ADD CONSTRAINT `users_userGroup_FK_1`
	FOREIGN KEY (`userId`)
	REFERENCES `users_user` (`id`);

ALTER TABLE `users_userGroup` ADD CONSTRAINT `users_userGroup_FK_2`
	FOREIGN KEY (`groupId`)
	REFERENCES `users_group` (`id`)
	ON DELETE CASCADE;

ALTER TABLE `users_userInfo` ADD CONSTRAINT `users_userInfo_FK_1`
	FOREIGN KEY (`userId`)
	REFERENCES `users_user` (`id`);

CREATE TABLE `modules_module`
(
	`name` VARCHAR(255) NOT NULL COMMENT \'nombre del modulo\',
	`active` TINYINT DEFAULT 0 NOT NULL COMMENT \'Estado del modulo\',
	`alwaysActive` TINYINT DEFAULT 0 NOT NULL COMMENT \'Modulo siempre activo\',
	`hasCategories` TINYINT DEFAULT 0 NOT NULL COMMENT \'El Modulo tiene categorias relacionadas?\',
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

DROP TABLE IF EXISTS `modules_module`;

DROP TABLE IF EXISTS `modules_dependency`;

DROP TABLE IF EXISTS `modules_label`;

DROP TABLE IF EXISTS `modules_entity`;

DROP TABLE IF EXISTS `modules_entityField`;

DROP TABLE IF EXISTS `modules_entityFieldValidation`;

ALTER TABLE `MER_actor` DROP FOREIGN KEY `MER_actor_FK_1`;

ALTER TABLE `MER_actor` CHANGE `name` `name` VARCHAR(255) NOT NULL;

ALTER TABLE `MER_actor` CHANGE `active` `active` INTEGER NOT NULL;

ALTER TABLE `MER_actor` CHANGE `strategy` `strategy` TEXT;

ALTER TABLE `MER_actor` CHANGE `tactic` `tactic` TEXT;

ALTER TABLE `MER_actor` CHANGE `observations` `observations` TEXT;

ALTER TABLE `MER_actor` DROP `title`;

ALTER TABLE `MER_actor` DROP `surname`;

ALTER TABLE `MER_actor` DROP `comments`;

ALTER TABLE `MER_actor` DROP `deleted_at`;

ALTER TABLE `MER_actor` DROP `created_at`;

ALTER TABLE `MER_actor` DROP `updated_at`;

ALTER TABLE `MER_actorActiveQuestion` DROP FOREIGN KEY `MER_actorActiveQuestion_FK_1`;

ALTER TABLE `MER_actorActiveQuestion` DROP FOREIGN KEY `MER_actorActiveQuestion_FK_2`;

CREATE INDEX `MER_ActorActiveQuestion_FI_1` ON `mer_actoractivequestion` (`actorId`);

ALTER TABLE `MER_category` CHANGE `active` `active` INTEGER NOT NULL;

ALTER TABLE `MER_document` DROP FOREIGN KEY `MER_document_FK_1`;

DROP INDEX `MER_document_FI_1` ON `MER_document`;

ALTER TABLE `MER_document` CHANGE `categoryId` `type` INTEGER;

ALTER TABLE `MER_document` DROP `realFilename`;

ALTER TABLE `MER_document` DROP `password`;

ALTER TABLE `MER_document` DROP `fullTextContent`;

ALTER TABLE `MER_form` DROP FOREIGN KEY `MER_form_FK_1`;

ALTER TABLE `MER_form` CHANGE `relationship` `relationship` INTEGER DEFAULT 0 NOT NULL;

ALTER TABLE `MER_formAnswer` DROP FOREIGN KEY `MER_formAnswer_FK_1`;

ALTER TABLE `MER_formAnswer` DROP FOREIGN KEY `MER_formAnswer_FK_2`;

ALTER TABLE `MER_formSection` DROP FOREIGN KEY `MER_formSection_FK_1`;

ALTER TABLE `MER_formSectionQuestion` DROP FOREIGN KEY `MER_formSectionQuestion_FK_1`;

ALTER TABLE `MER_formSectionQuestion` CHANGE `analysis` `analysis` INTEGER DEFAULT 0;

ALTER TABLE `MER_formSectionQuestionOption` DROP FOREIGN KEY `MER_formSectionQuestionOption_FK_1`;

ALTER TABLE `MER_formSectionQuestionOption` CHANGE `defaultOpc` `defaultOpc` INTEGER;

ALTER TABLE `MER_graphActor` DROP FOREIGN KEY `MER_graphActor_FK_1`;

ALTER TABLE `MER_graphActor` DROP FOREIGN KEY `MER_graphActor_FK_2`;

ALTER TABLE `MER_graphActor` DROP FOREIGN KEY `MER_graphActor_FK_3`;

ALTER TABLE `MER_graphCategory` DROP FOREIGN KEY `MER_graphCategory_FK_1`;

ALTER TABLE `MER_graphCategory` DROP FOREIGN KEY `MER_graphCategory_FK_2`;

ALTER TABLE `MER_graphModelAxis` DROP FOREIGN KEY `MER_graphModelAxis_FK_1`;

ALTER TABLE `MER_graphModelAxis` DROP FOREIGN KEY `MER_graphModelAxis_FK_2`;

ALTER TABLE `MER_graphModelAxis` CHANGE `axis` `axis` CHAR NOT NULL;

ALTER TABLE `MER_graphModelJudgement` DROP FOREIGN KEY `MER_graphModelJudgement_FK_1`;

ALTER TABLE `MER_graphRelation` DROP FOREIGN KEY `MER_graphRelation_FK_1`;

ALTER TABLE `MER_graphRelation` DROP FOREIGN KEY `MER_graphRelation_FK_2`;

ALTER TABLE `MER_graphRelationQuestion` DROP FOREIGN KEY `MER_graphRelationQuestion_FK_1`;

ALTER TABLE `MER_graphRelationQuestion` DROP FOREIGN KEY `MER_graphRelationQuestion_FK_2`;

ALTER TABLE `MER_hierarchy` DROP FOREIGN KEY `MER_hierarchy_FK_1`;

ALTER TABLE `MER_hierarchy` DROP FOREIGN KEY `MER_hierarchy_FK_2`;

ALTER TABLE `MER_judgementActor` DROP FOREIGN KEY `MER_judgementActor_FK_1`;

ALTER TABLE `MER_relationship` DROP FOREIGN KEY `MER_relationship_FK_1`;

ALTER TABLE `MER_relationship` DROP FOREIGN KEY `MER_relationship_FK_2`;

ALTER TABLE `MER_relationship` DROP FOREIGN KEY `MER_relationship_FK_3`;

ALTER TABLE `MER_relationshipActiveQuestion` DROP FOREIGN KEY `MER_relationshipActiveQuestion_FK_1`;

ALTER TABLE `MER_relationshipActiveQuestion` DROP FOREIGN KEY `MER_relationshipActiveQuestion_FK_2`;

ALTER TABLE `MER_relationshipActiveQuestion` DROP FOREIGN KEY `MER_relationshipActiveQuestion_FK_3`;

ALTER TABLE `multilang_text` DROP FOREIGN KEY `multilang_text_FK_1`;

ALTER TABLE `multilang_text` DROP FOREIGN KEY `multilang_text_FK_2`;

ALTER TABLE `securityaction` ADD
(
	`pair` VARCHAR(100)
);

ALTER TABLE `users_group` ADD
(
	`bitLevel` INTEGER
);

ALTER TABLE `users_groupCategory` DROP FOREIGN KEY `users_groupCategory_FK_1`;

ALTER TABLE `users_groupCategory` DROP FOREIGN KEY `users_groupCategory_FK_2`;

ALTER TABLE `users_user` DROP FOREIGN KEY `users_user_FK_1`;

DROP INDEX `users_user_FI_1` ON `users_user`;

ALTER TABLE `users_user` CHANGE `active` `active` INTEGER NOT NULL;

ALTER TABLE `users_user` CHANGE `levelId` `levelid` INTEGER NOT NULL;

ALTER TABLE `users_userGroup` DROP FOREIGN KEY `users_userGroup_FK_1`;

ALTER TABLE `users_userGroup` DROP FOREIGN KEY `users_userGroup_FK_2`;

ALTER TABLE `users_userInfo` DROP FOREIGN KEY `users_userInfo_FK_1`;

CREATE TABLE `mluse_language`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NOT NULL,
	`code` VARCHAR(30) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE `mluse_text`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`languageId` INTEGER NOT NULL,
	`text` TEXT NOT NULL,
	PRIMARY KEY (`id`,`languageId`),
	INDEX `Text_ibfk_1` (`languageId`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
	}

}