DELETE FROM `actionLogs_label` WHERE `action` LIKE 'services%' AND `language` = 'eng';
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'ServicesMultilangLanguagesDoEdit', 'Text edited sucessfully','eng','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'ServicesMultilangLanguagesDoEdit', 'Error saving text','eng','failure');
