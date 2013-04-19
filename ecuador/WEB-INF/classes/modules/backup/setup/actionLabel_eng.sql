DELETE FROM `security_actionLabel` WHERE `action` LIKE 'Backup%' AND `language` = 'eng';
OPTIMIZE TABLE `security_actionLabel`;
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('BackupDelete', 'Delete Backup', 'Delete Backup file from server', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('BackupRestore', 'Restore backup', 'Restore system info from a backup file', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('BackupDownload', 'Download backup', 'Download backup to a local file', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('BackupSendByEmail', 'Send backup by mail', 'Send backup file attached to a mail', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('BackupCreate', 'Create backup on server', 'Create backup file on server', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('BackupList', 'Backups list', 'Display backups files list available on server', 'eng');
