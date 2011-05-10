DELETE FROM `modules_module` WHERE `name` = 'positions';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('positions', '1', '','');
DELETE FROM `modules_dependency` WHERE `moduleName` = 'positions';
