DELETE FROM `modules_label` WHERE `name` = 'common' and `language` = 'eng';
OPTIMIZE TABLE `modules_label`;
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('common', 'Common', 'Common system wide applications', 'eng');
