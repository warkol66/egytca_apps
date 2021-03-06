DELETE FROM `actionLogs_label` WHERE `action` LIKE 'Backup%' AND `language` = 'esp';
OPTIMIZE TABLE `actionLogs_label`;
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'BackupCreate', 'Respaldo creado en el servidor con éxito','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'BackupCreate', 'Error al crear respaldo en el servidor','esp','failure');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'BackupRestore', 'Respaldo restaurado desde el servidor con éxito','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'BackupRestore', 'Error restaurando respaldo desde el servidor','esp','failure');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'BackupDoDelete', 'Elimando archivo de respaldo','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'BackupDoDelete', 'No se pudo eliminar archivo de respaldo','esp','failure');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'BackupSendByEmail', 'Archivo de respaldo enviado por correo electrónico','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'BackupSendByEmail', 'No se pudo enviar el archivo de respaldo','esp','failure');
