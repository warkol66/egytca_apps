DELETE FROM `modules_module` WHERE `name` = 'blog';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('blog', '1', '1','');
DELETE FROM `modules_dependency` WHERE `moduleName` = 'blog';
