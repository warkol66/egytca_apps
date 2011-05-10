DELETE FROM `modules_label` WHERE `name` = 'segmentation' and `language` = 'esp';
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('segmentation', 'Sgmentación', 'Administra segmentación de usuariso registrados', 'esp');
