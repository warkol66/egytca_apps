DELETE FROM `modules_module` WHERE `name` = 'services';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('services', '1', '','');
DELETE FROM `modules_dependency` WHERE `moduleName` = 'services';
