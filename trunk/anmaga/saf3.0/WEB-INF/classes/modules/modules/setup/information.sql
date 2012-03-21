DELETE FROM `modules_module` WHERE `name` = 'modules';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('modules', '1', '','');
DELETE FROM `modules_dependency` WHERE `moduleName` = 'modules';
