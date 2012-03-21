DELETE FROM `modules_label` WHERE `name` = 'orders' and `language` = 'esp';
OPTIMIZE TABLE `modules_label`;
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('orders', 'Órdenes', 'Administrar pedidos', 'esp');
