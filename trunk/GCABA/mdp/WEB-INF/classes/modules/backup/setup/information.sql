DELETE FROM `modules_module` WHERE `name` = 'backup';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('backup', '1', '','');
DELETE FROM `modules_dependency` WHERE `moduleName` = 'backup';
