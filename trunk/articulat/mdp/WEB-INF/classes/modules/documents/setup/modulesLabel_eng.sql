DELETE FROM `modules_label` WHERE `name` = 'documents' and `language` = 'eng';
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('documents', 'Documents', 'Documents management module', 'eng');
