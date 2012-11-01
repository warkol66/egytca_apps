DELETE FROM `modules_module` WHERE `name` = 'affiliates';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('affiliates', '1', '','');
DELETE FROM `modules_dependency` WHERE `moduleName` = 'affiliates';
