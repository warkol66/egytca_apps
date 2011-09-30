DELETE FROM `actionLogs_label` WHERE `action` LIKE 'Modules%' AND `language` = 'esp';
OPTIMIZE TABLE `actionLogs_label`;
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'ModulesEntitiesFieldsDoEdit', 'Cambios en campo guardados','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'ModulesInstallSetupMessages', 'Se ha instalado el módulo','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'ModulesInstallSetupMessages', 'No se pudo instalar el módulos','esp','failure');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'ModulesInstallSetupMessages', 'No se pudo instalar el módulo por fallas en xml','esp','failure-xml');
