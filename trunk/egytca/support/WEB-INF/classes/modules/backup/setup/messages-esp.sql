DELETE FROM `actionLogs_label` WHERE `action` LIKE 'Backup%' AND `language` = 'esp';
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'BackupCreate', 'Respaldo creado en el servidor con éxito','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'BackupCreate', 'Error al crear respaldo en el servidor','esp','failure');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'BackupRestore', 'Respaldo restaurado desde el servidor con éxito','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'BackupRestore', 'Error restaurando respaldo desde el servidor','esp','failure');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'BackupRestoreFromFile', 'Respaldo restaurado desde archivo con éxito','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'BackupRestoreFromFile', 'Error restaurando respaldo desde el archivo','esp','failure');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'BackupDelete', 'Backup eliminado del servidor con éxito','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'BackupDelete', 'Error al eliminar respaldo del servidor','esp','failure');
