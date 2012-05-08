DELETE FROM `actionLogs_label` WHERE `action` LIKE 'Actors%' AND `language` = 'esp';
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'ActorsDoEdit', 'Funcionario creado/modificado','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'ActorsDoEdit', 'Error en creación/modificación de funcionario','esp','failure');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'ActorsDoEditX', 'Funcionario creado','esp','success');
