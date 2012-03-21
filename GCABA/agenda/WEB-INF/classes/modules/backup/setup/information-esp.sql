DELETE FROM `modules_label` WHERE `name` = 'backup' AND `language` = 'esp';
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('backup', 'Respaldo', 'Módulo para creación y administración de copias de seguridad', 'esp');
