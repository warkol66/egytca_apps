DELETE FROM `modules_module` WHERE `name` = 'catalog';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('catalog', '1', '','1');
DELETE FROM `modules_dependency` WHERE `moduleName` = 'catalog';
