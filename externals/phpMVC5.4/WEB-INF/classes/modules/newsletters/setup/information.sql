DELETE FROM `modules_label` WHERE `name` = 'newsletters';
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('newsletters', 'Gacetillas', 'Adminstraci�n de Gacetillas', 'esp');
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('newsletters', 'Newsletters', 'Newsletters management', 'eng');
DELETE FROM `modules_dependency` WHERE `moduleName` = 'newsletters';
INSERT INTO `modules_dependency` ( `moduleName` , `dependence` ) VALUES ('newsletters', 'news');
INSERT INTO `modules_dependency` ( `moduleName` , `dependence` ) VALUES ('newsletters', 'segmentation');
DELETE FROM `modules_module` WHERE `name` = 'newsletters';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('newsletters', '1', '','');
