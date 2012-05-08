DELETE FROM `actionLogs_label` WHERE `action` LIKE 'Positions%' AND `language` = 'esp';
OPTIMIZE TABLE `actionLogs_label`;
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'PositionsVersionsDoEdit', 'Se modificó la versión satisfactoriamente','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'PositionsVersionsDoEdit', 'Se creó una versión satisfactoriamente','esp','successCreate');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'PositionsVersionsDoEdit', 'No se pudo guardar la ifnormación','esp','failure');
