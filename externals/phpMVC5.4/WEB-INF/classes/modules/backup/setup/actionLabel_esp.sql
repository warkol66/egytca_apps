DELETE FROM `security_actionLabel` WHERE `action` LIKE 'Backup%' AND `language` = 'esp';
OPTIMIZE TABLE `security_actionLabel`;
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('BackupDelete', 'Eliminar respaldo', 'Elimina respaldo guardado en el servidor', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('BackupRestore', 'Restaurar respaldo', 'Restaura la información guardada en un archivo de respaldo', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('BackupDownload', 'Descargar archivo de respaldo', 'Descarga archivo de respaldo a equipo local', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('BackupSendByEmail', 'Enviar respaldo por mail', 'Enviar archivo de respaldo por correo electrónico', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('BackupCreate', 'Crear respaldo en servidor', 'Crea archivo de respaldo en servidor', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('BackupList', 'Listado de respaldos disponibles', 'Muestra el listado de respaldos disponibles en el servidor', 'esp');
