DELETE FROM `modules_module` WHERE `name` = 'tablero';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('tablero', '1', '','');
DELETE FROM `modules_dependency` WHERE `moduleName` = 'tablero';
