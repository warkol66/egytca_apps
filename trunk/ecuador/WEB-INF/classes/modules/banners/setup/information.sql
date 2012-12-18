DELETE FROM `modules_module` WHERE `name` = 'banners';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('banners', '1', '','');
DELETE FROM `modules_dependency` WHERE `moduleName` = 'banners';
