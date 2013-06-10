DELETE FROM `actionLogs_label` WHERE `action` LIKE 'Backup%' AND `language` = 'eng';
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'BackupCreate', 'Backup succesfully created on the server','eng','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'BackupCreate', 'Backup creation on server failed','eng','failure');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'BackupRestore', 'Successfully restored backup from server','eng','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'BackupRestore', 'Backup restore from server error','eng','failure');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'BackupRestoreFromFile', 'Backup successfully restored from file','eng','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'BackupRestoreFromFile', 'Backup restore from file failed','eng','failure');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'BackupDelete', 'Backup deleted successfully from server','eng','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'BackupDelete', 'Backup deletion from server failed','eng','failure');
