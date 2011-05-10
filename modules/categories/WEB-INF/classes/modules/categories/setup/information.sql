DELETE FROM `modules_module` WHERE `name` = 'categories';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('categories', '1', '','');
DELETE FROM `modules_dependency` WHERE `moduleName` = 'categories';
