DELETE FROM `modules_label` WHERE `name` = 'import';
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('import', 'Importaciones', 'AdministraciÃ³n de Importaciones/Exportaciones', 'esp');
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('import', 'Import/Export', 'Import/Export Management', 'eng');
DELETE FROM `modules_dependency` WHERE `moduleName` = 'import';
DELETE FROM `modules_module` WHERE `name` = 'import';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('import', '1', '','');
