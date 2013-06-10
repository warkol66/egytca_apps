DELETE FROM `modules_module` WHERE `name` = 'documents';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('documents', '1', '','1');
DELETE FROM `modules_dependency` WHERE `moduleName` = 'documents';
