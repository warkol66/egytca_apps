DELETE FROM `modules_label` WHERE `name` = 'users' and `language` = 'esp';
OPTIMIZE TABLE `modules_label`;
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('users', 'Usuarios', 'Módulo de Administración de Usuarios', 'esp');
