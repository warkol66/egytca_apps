DELETE FROM `actionLogs_label` WHERE `action` LIKE 'multilang%' AND `language` = 'eng';
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'MultilangLanguagesDoEdit', 'Text edited sucessfully','eng','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'MultilangLanguagesDoEdit', 'Error saving text','eng','failure');
