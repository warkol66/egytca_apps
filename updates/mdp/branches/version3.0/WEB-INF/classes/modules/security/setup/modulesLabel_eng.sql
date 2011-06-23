DELETE FROM `modules_label` WHERE `name` = 'security' and `language` = 'eng';
OPTIMIZE TABLE `modules_label`;
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('security', 'Security', 'Permission management', 'eng');
