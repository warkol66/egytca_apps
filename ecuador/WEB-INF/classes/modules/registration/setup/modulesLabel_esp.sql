DELETE FROM `modules_label` WHERE `name` = 'registration' and `language` = 'esp';
OPTIMIZE TABLE `modules_label`;
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('registration', 'Usuarios por registro', 'Administrador de usuarios por registro', 'esp');
