DELETE FROM `modules_label` WHERE `name` = 'planning' and `language` = 'esp';
OPTIMIZE TABLE `modules_label`;
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('planning', 'Planeamiento', 'Módulo de Planeamiento del Tablero de Gestión', 'esp');
