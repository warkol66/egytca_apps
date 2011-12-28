DELETE FROM `security_actionLabel` WHERE `action` LIKE 'Security%' AND `language` = 'esp';
OPTIMIZE TABLE `security_actionLabel`;
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('SecurityEditPermissions', 'Modificar permisos de usuarios', 'Modifica permisos de usuarios', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('SecurityNoPermission', 'Notificación de falta de permisos para la acción solicitada', 'Notifica al usuario que no tiene permisos sobre la acción solicitada', 'esp');
