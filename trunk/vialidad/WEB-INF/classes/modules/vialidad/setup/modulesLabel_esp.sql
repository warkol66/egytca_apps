DELETE FROM `modules_label` WHERE `name` = 'vialidad' and `language` = 'esp';
OPTIMIZE TABLE `modules_label`;
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('vialidad', 'Vialidad', 'Módulo con funcionalidades propial del Ministerio de Obras Públicas y Comunicaciones', 'esp');
