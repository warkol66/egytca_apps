DELETE FROM `security_actionLabel` WHERE `action` LIKE 'Security%' AND `language` = 'esp';
OPTIMIZE TABLE `security_actionLabel`;
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('SecurityEditPermissions', 'Modificar permisos', 'Modifica permisos de acceso', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('SecurityNoPermission', 'Mostrar negación de acceso ', 'Muestra mensaje de negación de aacceso por falta de permisos', 'esp');
