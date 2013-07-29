DELETE FROM `modules_label` WHERE `name` = 'backup' AND `language` = 'eng';
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('backup', 'Backup', 'Manage system and information backups', 'eng');
