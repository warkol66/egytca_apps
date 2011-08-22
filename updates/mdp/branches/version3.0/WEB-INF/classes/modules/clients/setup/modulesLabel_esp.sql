DELETE FROM `modules_label` WHERE `name` = 'clients' and `language` = 'esp';
OPTIMIZE TABLE `modules_label`;
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('clients', 'Clientes', 'Administración de clientes', 'esp');
