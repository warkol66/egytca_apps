DELETE FROM `modules_label` WHERE `name` = 'modules' and `language` = 'eng';
OPTIMIZE TABLE `modules_label`;
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('modules', 'Modules', 'System modules management', 'eng');
