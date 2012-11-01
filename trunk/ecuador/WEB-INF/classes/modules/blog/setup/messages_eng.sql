DELETE FROM `actionLogs_label` WHERE `action` LIKE 'blog%' AND `language` = 'eng';
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'BlogSendToEmailX', 'Blog sent sucessfully','eng','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'BlogSendToEmailX', 'Error sending blog entry','eng','failure');
