DELETE FROM `modules_module` WHERE `name` = 'studycases';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('studycases', '1', '','');
DELETE FROM `modules_dependency` WHERE `moduleName` = 'studycases';
