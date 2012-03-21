DELETE FROM `modules_label` WHERE `name` = 'users' and `language` = 'eng';
OPTIMIZE TABLE `modules_label`;
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('users', 'Users', 'Users management', 'eng');
