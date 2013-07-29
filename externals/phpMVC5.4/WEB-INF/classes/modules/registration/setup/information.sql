DELETE FROM `modules_module` WHERE `name` = 'registration';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('registration', '1', '','');
DELETE FROM `modules_dependency` WHERE `moduleName` = 'registration';
