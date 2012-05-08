DELETE FROM `modules_label` WHERE `name` = 'backup' and `language` = 'eng';
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('backup', 'Backups', 'Backups management', 'eng');
