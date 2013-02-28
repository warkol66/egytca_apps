DELETE FROM `modules_module` WHERE `name` = 'panel';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('panel', '1', '','');
DELETE FROM `modules_dependency` WHERE `moduleName` = 'panel';
