DELETE FROM `modules_module` WHERE `name` = 'security';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('security', '1', '','');
DELETE FROM `modules_dependency` WHERE `moduleName` = 'security';
