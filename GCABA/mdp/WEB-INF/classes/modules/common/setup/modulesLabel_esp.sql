DELETE FROM `modules_label` WHERE `name` = 'common' and `language` = 'esp';
OPTIMIZE TABLE `modules_label`;
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('common', 'General', 'Aplicaciones comunes al sistema', 'esp');
