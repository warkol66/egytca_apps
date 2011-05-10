DELETE FROM `modules_module` WHERE `name` = 'segmentation';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('segmentation', '1', '','');
DELETE FROM `modules_dependency` WHERE `moduleName` = 'segmentation';
