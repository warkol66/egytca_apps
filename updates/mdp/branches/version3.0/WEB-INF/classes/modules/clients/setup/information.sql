DELETE FROM `modules_module` WHERE `name` = 'clients';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('clients', '1', '','');
DELETE FROM `modules_dependency` WHERE `moduleName` = 'clients';
