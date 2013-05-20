DELETE FROM `actionLogs_label` WHERE `action` LIKE 'Regions%' AND `language` = 'eng';
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'RegionsDoEdit', 'Region created/edited sucessfully','eng','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'RegionsDoEdit', 'Error saving changes to region','eng','failure');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'RegionsDoDelete', 'Region deleted','eng','success');
