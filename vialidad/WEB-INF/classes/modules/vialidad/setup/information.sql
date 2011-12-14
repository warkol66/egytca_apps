DELETE FROM `modules_module` WHERE `name` = 'vialidad';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('vialidad', '1', '','');
DELETE FROM `modules_dependency` WHERE `moduleName` = 'vialidad';
