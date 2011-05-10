DELETE FROM `actionLogs_label` WHERE `action` LIKE 'Regions%' AND `language` = 'esp';
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'RegionsDoEdit', 'Región creada/modificada exitosamete','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'RegionsDoEdit', 'Error al guardar la región','esp','failure');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'RegionsDoDelete', 'Region eliminada exitosamete','esp','success');
