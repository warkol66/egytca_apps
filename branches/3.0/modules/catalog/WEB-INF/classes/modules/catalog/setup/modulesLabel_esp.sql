DELETE FROM `modules_label` WHERE `name` = 'catalog' and `language` = 'esp';
OPTIMIZE TABLE `modules_label`;
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('catalog', 'Catálogo', 'Administra catálogo de productos', 'esp');
