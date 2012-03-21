DELETE FROM `modules_module` WHERE `name` = 'common';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('common', '1', '1','');
DELETE FROM `modules_dependency` WHERE `moduleName` = 'common';
