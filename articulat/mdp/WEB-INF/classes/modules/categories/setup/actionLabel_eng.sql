DELETE FROM `security_actionLabel` WHERE `action` LIKE 'Categories%' AND `language` = 'eng';
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('CategoriesEdit', 'Edit category', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('CategoriesList', 'Categories list', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('CategoriesDoDelete', 'Delete category', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('CategoriesDoEditX', 'Edit category', 'eng');
