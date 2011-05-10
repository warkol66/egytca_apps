DELETE FROM `modules_module` WHERE `name` = 'news';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('news', '1', '','');
DELETE FROM `modules_dependency` WHERE `moduleName` = 'news';
