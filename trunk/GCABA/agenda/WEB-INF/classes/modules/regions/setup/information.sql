DELETE FROM `modules_module` WHERE `name` = 'regions';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('regions', '1', '','');
DELETE FROM `modules_dependency` WHERE `moduleName` = 'regions';
