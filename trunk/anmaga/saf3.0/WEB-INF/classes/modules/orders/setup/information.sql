DELETE FROM `modules_module` WHERE `name` = 'orders';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('orders', '1', '','');
DELETE FROM `modules_dependency` WHERE `moduleName` = 'orders';
