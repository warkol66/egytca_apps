
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- categories_category
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `categories_category`;

CREATE TABLE `categories_category`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'Id de la categoria',
    `name` VARCHAR(255) NOT NULL COMMENT 'Category name',
    `module` VARCHAR(255) DEFAULT '' COMMENT 'Module name if it is for a module',
    `active` TINYINT(1) NOT NULL COMMENT 'Is category active?',
    `isPublic` TINYINT(1) DEFAULT 0 NOT NULL COMMENT 'Is category public?',
    `responsible` VARCHAR(255) NOT NULL COMMENT 'Responsable de la dependendencia',
    `deleted_at` DATETIME,
    `tree_left` INTEGER,
    `tree_right` INTEGER,
    `tree_level` INTEGER,
    `scope` INTEGER,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM CHARACTER SET='utf8' COLLATE='utf8_general_ci' COMMENT='Categorias';

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
