DELETE FROM `modules_module` WHERE `name` = 'surveys';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('surveys', '1', '','');
DELETE FROM `modules_dependency` WHERE `moduleName` = 'surveys';
