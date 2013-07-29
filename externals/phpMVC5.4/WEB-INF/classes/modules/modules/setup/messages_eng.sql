DELETE FROM `actionLogs_label` WHERE `action` LIKE 'Modules%' AND `language` = 'eng';
OPTIMIZE TABLE `actionLogs_label`;
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'ModulesEntitiesFieldsDoEdit', 'Fields changes saved','eng','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'ModulesInstallSetupMessages', 'Module installed sucessfully','eng','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'ModulesInstallSetupMessages', 'Module installation failed','eng','failure');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'ModulesInstallSetupMessages', 'Module installation failed','eng','failure-xml');
