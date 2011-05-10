DELETE FROM `modules_label` WHERE `name` = 'studycases' and `language` = 'esp';
OPTIMIZE TABLE `modules_label`;
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('studycases', 'Experiencias', 'Experiencias', 'esp');
