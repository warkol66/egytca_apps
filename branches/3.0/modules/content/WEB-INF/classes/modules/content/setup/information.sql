DELETE FROM `modules_module` WHERE `name` = 'content';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('content', '1', '','');
DELETE FROM `modules_dependency` WHERE `moduleName` = 'content';
