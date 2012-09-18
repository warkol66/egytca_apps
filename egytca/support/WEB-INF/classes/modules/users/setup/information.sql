DELETE FROM `modules_module` WHERE `name` = 'users';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('users', '1', '1','');
DELETE FROM `modules_dependency` WHERE `moduleName` = 'users';
