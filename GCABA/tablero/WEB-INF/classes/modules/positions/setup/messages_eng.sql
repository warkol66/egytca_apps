DELETE FROM `actionLogs_label` WHERE `action` LIKE 'Positions%' AND `language` = 'eng';
OPTIMIZE TABLE `actionLogs_label`;
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'PositionsVersionsDoEdit', 'Version edit sucess','eng','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'PositionsVersionsDoEdit', 'Version created','eng','successCreate');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'PositionsVersionsDoEdit', 'Information not saved','eng','failure');
