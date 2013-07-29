DELETE FROM `modules_label` WHERE `name` = 'documents' and `language` = 'esp';
OPTIMIZE TABLE `modules_label`;
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('documents', 'Documentos', 'Módulo para administración de documentos', 'esp');
