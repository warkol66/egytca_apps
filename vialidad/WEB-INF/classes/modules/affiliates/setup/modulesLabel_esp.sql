DELETE FROM `modules_label` WHERE `name` = 'affiliates' and `language` = 'esp';
OPTIMIZE TABLE `modules_label`;
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('affiliates', 'Contratistas', 'Administración de Empresas Asociadas', 'esp');
