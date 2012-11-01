DELETE FROM `modules_label` WHERE `name` = 'security' and `language` = 'esp';
OPTIMIZE TABLE `modules_label`;
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('security', 'Seguridad', 'Administración de permisos', 'esp');
