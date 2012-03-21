DELETE FROM `modules_label` WHERE `name` = 'catalog' and `language` = 'eng';
OPTIMIZE TABLE `modules_label`;
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('catalog', 'Catalog', 'Products catalog management', 'eng');
