DELETE FROM `actionLogs_label` WHERE `action` LIKE 'Modules%' AND `language` = 'eng';
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'ModulesList', 'List modules','eng','success');
