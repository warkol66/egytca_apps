DELETE FROM `modules_module` WHERE `name` = 'planning';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('planning', '1', '','');
DELETE FROM `modules_dependency` WHERE `moduleName` = 'planning';
