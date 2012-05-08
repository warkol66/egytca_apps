DELETE FROM `actionLogs_label` WHERE `action` LIKE 'Actors%' AND `language` = 'eng';
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'ActorsDoEdit', 'Actor created/edited','eng','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'ActorsDoEdit', 'Error creating/editing actor','eng','failure');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'ActorsDoEditX', 'Actor created','eng','success');
