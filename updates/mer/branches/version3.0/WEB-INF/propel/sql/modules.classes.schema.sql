
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- modules_module
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `modules_module`;

CREATE TABLE `modules_module`
(
	`name` VARCHAR(255) NOT NULL COMMENT 'nombre del modulo',
	`active` TINYINT DEFAULT 0 NOT NULL COMMENT 'Estado del modulo',
	`alwaysActive` TINYINT DEFAULT 0 NOT NULL COMMENT 'Modulo siempre activo',
	`hasCategories` TINYINT DEFAULT 0 NOT NULL COMMENT 'El Modulo tiene categorias relacionadas?',
	PRIMARY KEY (`name`)
) ENGINE=MyISAM CHARACTER SET='utf8' COLLATE='utf8_general_ci' COMMENT=' Registro de modulos';

-- ---------------------------------------------------------------------
-- modules_dependency
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `modules_dependency`;

CREATE TABLE `modules_dependency`
(
	`moduleName` VARCHAR(50) NOT NULL COMMENT 'Modulo',
	`dependence` VARCHAR(50) NOT NULL COMMENT 'Modulos de los cuales depende',
	PRIMARY KEY (`moduleName`,`dependence`),
	CONSTRAINT `modules_dependency_FK_1`
		FOREIGN KEY (`moduleName`)
		REFERENCES `modules_module` (`name`)
		ON DELETE CASCADE
) ENGINE=MyISAM CHARACTER SET='utf8' COLLATE='utf8_general_ci' COMMENT='Dependencia de modulos ';

-- ---------------------------------------------------------------------
-- modules_label
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `modules_label`;

CREATE TABLE `modules_label`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'Id module label',
	`name` VARCHAR(255) NOT NULL COMMENT 'nombre del modulo',
	`label` VARCHAR(255) COMMENT 'Etiqueta',
	`description` VARCHAR(255) COMMENT 'Descripcion del modulo',
	`language` VARCHAR(100) COMMENT 'idioma de la etiqueta',
	PRIMARY KEY (`id`,`name`),
	INDEX `modules_label_FI_1` (`name`),
	CONSTRAINT `modules_label_FK_1`
		FOREIGN KEY (`name`)
		REFERENCES `modules_module` (`name`)
		ON DELETE CASCADE
) ENGINE=MyISAM CHARACTER SET='utf8' COLLATE='utf8_general_ci' COMMENT='Etiquetas de modulos ';

-- ---------------------------------------------------------------------
-- modules_entity
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `modules_entity`;

CREATE TABLE `modules_entity`
(
	`moduleName` VARCHAR(50) NOT NULL COMMENT 'nombre del modulo',
	`name` VARCHAR(50) NOT NULL COMMENT 'Nombre de la entidad',
	`phpName` VARCHAR(50) COMMENT 'Nombre de la Clase',
	`description` VARCHAR(255) COMMENT 'Descripcion de la entidad',
	`softDelete` BOOL COMMENT 'Indica si usa softdelete',
	`relation` BOOL COMMENT 'Indica si es una entidad principal o una relacion de dos entidades',
	`saveLog` BOOL COMMENT 'Indica si guarda log de cambios',
	`nestedset` BOOL COMMENT 'Indica si es una entidad nestedset',
	`scopeFieldUniqueName` VARCHAR(100) COMMENT 'Indica el campo que es usado como scope en el nestedset',
	`behaviors` LONGBLOB COMMENT 'Indica los behaviors que tiene la entidad',
	PRIMARY KEY (`name`),
	INDEX `modules_entity_FI_1` (`moduleName`),
	INDEX `modules_entity_FI_2` (`scopeFieldUniqueName`),
	CONSTRAINT `modules_entity_FK_1`
		FOREIGN KEY (`moduleName`)
		REFERENCES `modules_module` (`name`),
	CONSTRAINT `modules_entity_FK_2`
		FOREIGN KEY (`scopeFieldUniqueName`)
		REFERENCES `modules_entityField` (`uniqueName`)
) ENGINE=MyISAM CHARACTER SET='utf8' COLLATE='utf8_general_ci' COMMENT='Entidades de modulos ';

-- ---------------------------------------------------------------------
-- modules_entityField
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `modules_entityField`;

CREATE TABLE `modules_entityField`
(
	`uniqueName` VARCHAR(100) NOT NULL COMMENT 'Nombre unico del campo',
	`entityName` VARCHAR(50) NOT NULL COMMENT 'Nombre de la entidad',
	`name` VARCHAR(50) NOT NULL COMMENT 'Nombre del campo (max 50 caracteres)',
	`description` VARCHAR(255) COMMENT 'Descripcion del campo (comment)',
	`isRequired` BOOL COMMENT 'Indica si es obligatorio',
	`defaultValue` VARCHAR(255) COMMENT 'Valor por defecto',
	`isPrimaryKey` BOOL COMMENT 'Indica si clave primaria',
	`isAutoIncrement` BOOL COMMENT 'Indica si el campo es autoincremental',
	`order` INTEGER NOT NULL COMMENT 'Orden',
	`type` INTEGER NOT NULL COMMENT 'Tipo de campo',
	`unique` BOOL COMMENT 'Indica si es unica',
	`size` INTEGER COMMENT 'Size del campo',
	`aggregateExpression` VARCHAR(255) COMMENT 'Detalles de la expresion agregada',
	`label` VARCHAR(255) COMMENT 'Etiqueta para el formulario',
	`formFieldType` INTEGER COMMENT 'Tipo de campo para formulario',
	`formFieldSize` INTEGER COMMENT 'Size del campo en formulario',
	`formFieldLines` INTEGER COMMENT 'Size del campo en formulario lineas',
	`formFieldUseCalendar` BOOL COMMENT 'Si utiliza o no el calendario en formulario',
	`foreignKeyTable` VARCHAR(50) COMMENT 'Entidad con la que enlaza la clave remota',
	`foreignKeyRemote` VARCHAR(100) COMMENT 'Nombre del campo en la tabla remota',
	`onDelete` VARCHAR(30) COMMENT 'Comportamiento onDelete',
	`automatic` BOOL COMMENT 'Indica si es una columna autogenerada por un behavior',
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
) ENGINE=MyISAM CHARACTER SET='utf8' COLLATE='utf8_general_ci' COMMENT='Campos de las entidades de modulos';

-- ---------------------------------------------------------------------
-- modules_entityFieldValidation
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `modules_entityFieldValidation`;

CREATE TABLE `modules_entityFieldValidation`
(
	`entityFieldUniqueName` VARCHAR(100) NOT NULL COMMENT 'Nombre unico del campo',
	`name` VARCHAR(50) NOT NULL COMMENT 'Nombre del validador',
	`value` VARCHAR(50) COMMENT 'Valor del validador',
	`message` VARCHAR(255) COMMENT 'Mensaje',
	PRIMARY KEY (`entityFieldUniqueName`,`name`),
	CONSTRAINT `modules_entityFieldValidation_FK_1`
		FOREIGN KEY (`entityFieldUniqueName`)
		REFERENCES `modules_entityField` (`uniqueName`)
		ON DELETE CASCADE
) ENGINE=MyISAM COMMENT='Validaciones de los campos de las entidades de modulos ';

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
