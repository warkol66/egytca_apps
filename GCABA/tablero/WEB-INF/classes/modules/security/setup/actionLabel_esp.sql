DELETE FROM `security_actionLabel` WHERE `action` LIKE 'Security%' AND `language` = 'esp';
OPTIMIZE TABLE `security_actionLabel`;
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('SecurityEditPermissions', 'Modificar permisos', 'Modificar permisos', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('NoPermission', 'No se tiene permiso sobre la acción solicitada', 'No se tiene permiso sobre la acción solicitada', 'esp');
