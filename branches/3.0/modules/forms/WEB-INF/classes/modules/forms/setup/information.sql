DELETE FROM `modules_module` WHERE `name` = 'forms';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('forms', '1', '','');
DELETE FROM `modules_dependency` WHERE `moduleName` = 'forms';
INSERT INTO `modules_dependency` ( `moduleName` , `dependence` ) VALUES ('forms', 'content');
