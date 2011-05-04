
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- MER_category
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `MER_category`;

CREATE TABLE `MER_category`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL COMMENT 'Category name',
	`active` TINYINT NOT NULL COMMENT 'Is category active?',
	`hierarchyActors` INTEGER NOT NULL COMMENT 'How many hierarchy actors can have the category',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM COMMENT='Categorias';

-- ---------------------------------------------------------------------
-- MER_hierarchy
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `MER_hierarchy`;

CREATE TABLE `MER_hierarchy`
(
	`actorId` INTEGER NOT NULL COMMENT 'Actor',
	`categoryId` INTEGER NOT NULL COMMENT 'Category',
	`position` INTEGER NOT NULL COMMENT 'Position',
	PRIMARY KEY (`actorId`,`categoryId`),
	INDEX `MER_hierarchy_FI_2` (`categoryId`),
	CONSTRAINT `MER_hierarchy_FK_1`
		FOREIGN KEY (`actorId`)
		REFERENCES `MER_actor` (`id`),
	CONSTRAINT `MER_hierarchy_FK_2`
		FOREIGN KEY (`categoryId`)
		REFERENCES `MER_category` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- MER_form
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `MER_form`;

CREATE TABLE `MER_form`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL,
	`relationship` TINYINT DEFAULT 0 NOT NULL COMMENT 'Is this form a relationship form (between cities)?',
	`rootSectionId` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `MER_form_FI_1` (`rootSectionId`),
	CONSTRAINT `MER_form_FK_1`
		FOREIGN KEY (`rootSectionId`)
		REFERENCES `MER_formSection` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- MER_formSection
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `MER_formSection`;

CREATE TABLE `MER_formSection`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`parentSectionId` INTEGER COMMENT 'Nested sections',
	`position` INTEGER NOT NULL COMMENT 'Section order',
	`title` VARCHAR(255) NOT NULL COMMENT 'Section title',
	PRIMARY KEY (`id`),
	INDEX `MER_formSection_I_1` (`parentSectionId`),
	CONSTRAINT `MER_formSection_FK_1`
		FOREIGN KEY (`parentSectionId`)
		REFERENCES `MER_formSection` (`id`)
		ON DELETE CASCADE
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- MER_formSectionQuestion
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `MER_formSectionQuestion`;

CREATE TABLE `MER_formSectionQuestion`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`sectionId` INTEGER NOT NULL,
	`type` SMALLINT NOT NULL,
	`question` VARCHAR(255) NOT NULL,
	`position` INTEGER NOT NULL,
	`unit` VARCHAR(20),
	`analysis` TINYINT DEFAULT 0 COMMENT 'Aparece la pregunta en analysis?',
	`label` VARCHAR(50) COMMENT 'Label de la pregunta',
	PRIMARY KEY (`id`),
	UNIQUE INDEX `MER_formSectionQuestion_U_1` (`label`),
	INDEX `MER_formSectionQuestion_FI_1` (`sectionId`),
	CONSTRAINT `MER_formSectionQuestion_FK_1`
		FOREIGN KEY (`sectionId`)
		REFERENCES `MER_formSection` (`id`)
		ON DELETE CASCADE
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- MER_formSectionQuestionOption
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `MER_formSectionQuestionOption`;

CREATE TABLE `MER_formSectionQuestionOption`
(
	`questionId` INTEGER NOT NULL,
	`position` INTEGER NOT NULL,
	`value` VARCHAR(255) NOT NULL,
	`text` VARCHAR(255) NOT NULL,
	`defaultOpc` TINYINT,
	PRIMARY KEY (`questionId`,`position`),
	CONSTRAINT `MER_formSectionQuestionOption_FK_1`
		FOREIGN KEY (`questionId`)
		REFERENCES `MER_formSectionQuestion` (`id`)
		ON DELETE CASCADE
) ENGINE=MyISAM COMMENT='Options for type-select questions';

-- ---------------------------------------------------------------------
-- MER_relationship
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `MER_relationship`;

CREATE TABLE `MER_relationship`
(
	`actor1Id` INTEGER NOT NULL,
	`actor2Id` INTEGER NOT NULL,
	`questionId` INTEGER NOT NULL,
	`direction` TINYINT NOT NULL,
	`current` VARCHAR(255) NOT NULL COMMENT 'Current relationship',
	`potential` VARCHAR(255) NOT NULL COMMENT 'Potential relationship',
	PRIMARY KEY (`actor1Id`,`actor2Id`,`questionId`,`direction`),
	INDEX `MER_relationship_FI_2` (`actor2Id`),
	INDEX `MER_relationship_FI_3` (`questionId`),
	CONSTRAINT `MER_relationship_FK_1`
		FOREIGN KEY (`actor1Id`)
		REFERENCES `MER_actor` (`id`),
	CONSTRAINT `MER_relationship_FK_2`
		FOREIGN KEY (`actor2Id`)
		REFERENCES `MER_actor` (`id`),
	CONSTRAINT `MER_relationship_FK_3`
		FOREIGN KEY (`questionId`)
		REFERENCES `MER_formSectionQuestion` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- MER_actorActiveQuestion
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `MER_actorActiveQuestion`;

CREATE TABLE `MER_actorActiveQuestion`
(
	`actorId` INTEGER NOT NULL,
	`questionId` INTEGER NOT NULL,
	PRIMARY KEY (`actorId`,`questionId`),
	INDEX `MER_actorActiveQuestion_FI_2` (`questionId`),
	CONSTRAINT `MER_actorActiveQuestion_FK_1`
		FOREIGN KEY (`actorId`)
		REFERENCES `MER_actor` (`id`),
	CONSTRAINT `MER_actorActiveQuestion_FK_2`
		FOREIGN KEY (`questionId`)
		REFERENCES `MER_formSectionQuestion` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- MER_relationshipActiveQuestion
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `MER_relationshipActiveQuestion`;

CREATE TABLE `MER_relationshipActiveQuestion`
(
	`actor1Id` INTEGER NOT NULL,
	`actor2Id` INTEGER NOT NULL,
	`questionId` INTEGER NOT NULL,
	PRIMARY KEY (`actor1Id`,`actor2Id`,`questionId`),
	INDEX `MER_relationshipActiveQuestion_FI_2` (`actor2Id`),
	INDEX `MER_relationshipActiveQuestion_FI_3` (`questionId`),
	CONSTRAINT `MER_relationshipActiveQuestion_FK_1`
		FOREIGN KEY (`actor1Id`)
		REFERENCES `MER_actor` (`id`),
	CONSTRAINT `MER_relationshipActiveQuestion_FK_2`
		FOREIGN KEY (`actor2Id`)
		REFERENCES `MER_actor` (`id`),
	CONSTRAINT `MER_relationshipActiveQuestion_FK_3`
		FOREIGN KEY (`questionId`)
		REFERENCES `MER_formSectionQuestion` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- MER_formAnswer
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `MER_formAnswer`;

CREATE TABLE `MER_formAnswer`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`actorId` INTEGER NOT NULL,
	`questionId` INTEGER NOT NULL,
	`answer` VARCHAR(255) NOT NULL,
	`judgement` VARCHAR(255) COMMENT 'Juicio',
	`old` INTEGER COMMENT 'Indica si el juicio esta vigente o no',
	PRIMARY KEY (`id`),
	INDEX `MER_formAnswer_FI_1` (`actorId`),
	INDEX `MER_formAnswer_FI_2` (`questionId`),
	CONSTRAINT `MER_formAnswer_FK_1`
		FOREIGN KEY (`actorId`)
		REFERENCES `MER_actor` (`id`)
		ON DELETE CASCADE,
	CONSTRAINT `MER_formAnswer_FK_2`
		FOREIGN KEY (`questionId`)
		REFERENCES `MER_formSectionQuestion` (`id`)
		ON DELETE CASCADE
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- MER_graphModel
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `MER_graphModel`;

CREATE TABLE `MER_graphModel`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'Id',
	`name` VARCHAR(255) COMMENT 'Nombre',
	`type` VARCHAR(30) COMMENT 'Tipo de Grafico',
	`actors` INTEGER NOT NULL COMMENT 'Cantidad de actores',
	`labelX` VARCHAR(100) COMMENT 'Label X',
	`labelY` VARCHAR(100) COMMENT 'Label Y',
	`labelZ` VARCHAR(100) COMMENT 'Label Z',
	`typeX` INTEGER COMMENT 'Type X',
	`typeY` INTEGER COMMENT 'Type Y',
	`typeZ` INTEGER COMMENT 'Type Z',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM COMMENT='Graficos modelos';

-- ---------------------------------------------------------------------
-- MER_graphModelAxis
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `MER_graphModelAxis`;

CREATE TABLE `MER_graphModelAxis`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'Id',
	`graphId` INTEGER NOT NULL COMMENT 'Id del grafico modelo',
	`axis` CHAR(1) NOT NULL COMMENT 'Eje',
	`type` INTEGER NOT NULL COMMENT 'Function de la pregunta sobre el valor del eje',
	`questionId` INTEGER NOT NULL COMMENT 'Id de la pregunta',
	PRIMARY KEY (`id`),
	INDEX `MER_graphModelAxis_FI_1` (`graphId`),
	INDEX `MER_graphModelAxis_FI_2` (`questionId`),
	CONSTRAINT `MER_graphModelAxis_FK_1`
		FOREIGN KEY (`graphId`)
		REFERENCES `MER_graphModel` (`id`)
		ON DELETE CASCADE,
	CONSTRAINT `MER_graphModelAxis_FK_2`
		FOREIGN KEY (`questionId`)
		REFERENCES `MER_formSectionQuestion` (`id`)
		ON DELETE CASCADE
) ENGINE=MyISAM COMMENT='Preguntas de los ejes de los graficos modelos';

-- ---------------------------------------------------------------------
-- MER_graphModelJudgement
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `MER_graphModelJudgement`;

CREATE TABLE `MER_graphModelJudgement`
(
	`graphId` INTEGER NOT NULL COMMENT 'Id del grafico modelo',
	`quadrant` INTEGER NOT NULL COMMENT 'Numero de cuadrante',
	`judgement` VARCHAR(255) COMMENT 'Juicio',
	PRIMARY KEY (`graphId`,`quadrant`),
	CONSTRAINT `MER_graphModelJudgement_FK_1`
		FOREIGN KEY (`graphId`)
		REFERENCES `MER_graphModel` (`id`)
		ON DELETE CASCADE
) ENGINE=MyISAM COMMENT='Juicios de graficos modelos';

-- ---------------------------------------------------------------------
-- MER_graphActor
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `MER_graphActor`;

CREATE TABLE `MER_graphActor`
(
	`graphId` INTEGER NOT NULL COMMENT 'Id del grafico modelo',
	`actorId` INTEGER NOT NULL COMMENT 'Actor',
	`categoryId` INTEGER COMMENT 'Categoria',
	`judgement` VARCHAR(255) COMMENT 'Juicio',
	`old` INTEGER COMMENT 'Indica si el juicio esta vigente o no',
	PRIMARY KEY (`graphId`,`actorId`),
	INDEX `MER_graphActor_FI_2` (`actorId`),
	INDEX `MER_graphActor_FI_3` (`categoryId`),
	CONSTRAINT `MER_graphActor_FK_1`
		FOREIGN KEY (`graphId`)
		REFERENCES `MER_graphModel` (`id`)
		ON DELETE CASCADE,
	CONSTRAINT `MER_graphActor_FK_2`
		FOREIGN KEY (`actorId`)
		REFERENCES `MER_actor` (`id`)
		ON DELETE CASCADE,
	CONSTRAINT `MER_graphActor_FK_3`
		FOREIGN KEY (`categoryId`)
		REFERENCES `MER_category` (`id`)
		ON DELETE CASCADE
) ENGINE=MyISAM COMMENT='Graficos';

-- ---------------------------------------------------------------------
-- MER_graphRelation
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `MER_graphRelation`;

CREATE TABLE `MER_graphRelation`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'Id del grafico',
	`name` VARCHAR(255) COMMENT 'Nombre',
	`actor1Id` INTEGER COMMENT 'Actor1',
	`actor2Id` INTEGER COMMENT 'Actor2',
	`judgement` VARCHAR(255) COMMENT 'Juicio',
	`old` INTEGER COMMENT 'Indica si el juicio esta vigente o no',
	PRIMARY KEY (`id`),
	INDEX `MER_graphRelation_FI_1` (`actor1Id`),
	INDEX `MER_graphRelation_FI_2` (`actor2Id`),
	CONSTRAINT `MER_graphRelation_FK_1`
		FOREIGN KEY (`actor1Id`)
		REFERENCES `MER_actor` (`id`)
		ON DELETE CASCADE,
	CONSTRAINT `MER_graphRelation_FK_2`
		FOREIGN KEY (`actor2Id`)
		REFERENCES `MER_actor` (`id`)
		ON DELETE CASCADE
) ENGINE=MyISAM COMMENT='Graficos de Relacion';

-- ---------------------------------------------------------------------
-- MER_graphRelationQuestion
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `MER_graphRelationQuestion`;

CREATE TABLE `MER_graphRelationQuestion`
(
	`graphRelationId` INTEGER NOT NULL COMMENT 'Id del grafico de relacion',
	`questionId` INTEGER NOT NULL COMMENT 'Id de la pregunta',
	PRIMARY KEY (`graphRelationId`,`questionId`),
	INDEX `MER_graphRelationQuestion_FI_2` (`questionId`),
	CONSTRAINT `MER_graphRelationQuestion_FK_1`
		FOREIGN KEY (`graphRelationId`)
		REFERENCES `MER_graphRelation` (`id`)
		ON DELETE CASCADE,
	CONSTRAINT `MER_graphRelationQuestion_FK_2`
		FOREIGN KEY (`questionId`)
		REFERENCES `MER_formSectionQuestion` (`id`)
		ON DELETE CASCADE
) ENGINE=MyISAM COMMENT='Preguntas de los graficos de relation';

-- ---------------------------------------------------------------------
-- MER_graphCategory
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `MER_graphCategory`;

CREATE TABLE `MER_graphCategory`
(
	`graphId` INTEGER NOT NULL COMMENT 'Id del grafico modelo',
	`categoryId` INTEGER NOT NULL COMMENT 'Categoria',
	`judgement` VARCHAR(255) COMMENT 'Juicio',
	`old` INTEGER COMMENT 'Indica si el juicio esta vigente o no',
	PRIMARY KEY (`graphId`,`categoryId`),
	INDEX `MER_graphCategory_FI_2` (`categoryId`),
	CONSTRAINT `MER_graphCategory_FK_1`
		FOREIGN KEY (`graphId`)
		REFERENCES `MER_graphModel` (`id`)
		ON DELETE CASCADE,
	CONSTRAINT `MER_graphCategory_FK_2`
		FOREIGN KEY (`categoryId`)
		REFERENCES `MER_category` (`id`)
		ON DELETE CASCADE
) ENGINE=MyISAM COMMENT='Graficos';

-- ---------------------------------------------------------------------
-- MER_judgementActor
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `MER_judgementActor`;

CREATE TABLE `MER_judgementActor`
(
	`actorId` INTEGER NOT NULL COMMENT 'Actor',
	`mark` INTEGER COMMENT 'Calificacion',
	`judgement` VARCHAR(255) COMMENT 'Juicio',
	`old` INTEGER COMMENT 'Indica si el juicio esta vigente o no',
	PRIMARY KEY (`actorId`),
	CONSTRAINT `MER_judgementActor_FK_1`
		FOREIGN KEY (`actorId`)
		REFERENCES `MER_actor` (`id`)
		ON DELETE CASCADE
) ENGINE=MyISAM COMMENT='Juicio general del actor';

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
