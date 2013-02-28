DELETE FROM `modules_label` WHERE `name` = 'panel' and `language` = 'esp';
OPTIMIZE TABLE `modules_label`;
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('panel', 'Tablero de Gestión', 'Módulo de Seguimiento del Tablero de Gestión', 'esp');
