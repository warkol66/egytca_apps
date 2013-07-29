DELETE FROM `modules_label` WHERE `name` = 'categories' and `language` = 'eng';
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('categories', 'Categories', 'Categories management', 'eng');
