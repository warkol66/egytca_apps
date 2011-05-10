DELETE FROM `modules_label` WHERE `name` = 'modules' and `language` = 'esp';
OPTIMIZE TABLE `modules_label`;
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('modules', 'Módulos', 'Administración de modulos del sistema', 'esp');
