DELETE FROM `security_actionLabel` WHERE `action` LIKE 'Studycases%' AND `language` = 'esp';
OPTIMIZE TABLE `security_actionLabel`;
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('StudycasesEdit', 'Editar experiencia', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('StudycasesList', 'Listar experiencias', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('StudycasesView', 'Ver experiencia', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('StudycasesDoDelete', 'Eliminar experiencia', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('StudycasesShow', 'vista pública de experiencias', 'esp');
