DELETE FROM `modules_label` WHERE `name` = 'multilang' and `language` = 'eng';
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('multilang', 'Multilanguage', 'Manages multilanguage messages', 'eng');
