DELETE FROM `modules_module` WHERE `name` = 'actors';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('actors', '1', '','');
DELETE FROM `modules_dependency` WHERE `moduleName` = 'actors';
