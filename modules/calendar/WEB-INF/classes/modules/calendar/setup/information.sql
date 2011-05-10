DELETE FROM `modules_module` WHERE `name` = 'calendar';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('calendar', '1', '','');
DELETE FROM `modules_dependency` WHERE `moduleName` = 'calendar';
