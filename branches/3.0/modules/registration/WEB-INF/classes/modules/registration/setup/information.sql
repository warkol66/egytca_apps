DELETE FROM `modules_label` WHERE `name` = 'registration';
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('registration', 'Registro', 'Registro de Usuarios', 'esp');
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('registration', 'Registration', 'Users registration', 'eng');

DELETE FROM `modules_dependency` WHERE `moduleName` = 'registration';

DELETE FROM `modules_module` WHERE `name` = 'registration';
INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('registration', '1', '','');
