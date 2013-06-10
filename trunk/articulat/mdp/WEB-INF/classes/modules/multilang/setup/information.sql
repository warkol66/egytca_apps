DELETE FROM `modules_module` WHERE `name` = 'multilang';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('multilang', '1', '','');
DELETE FROM `modules_dependency` WHERE `moduleName` = 'multilang';
