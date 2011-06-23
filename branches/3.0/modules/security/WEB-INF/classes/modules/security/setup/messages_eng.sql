DELETE FROM `actionLogs_label` WHERE `action` LIKE 'Security%' AND `language` = 'eng';
OPTIMIZE TABLE `actionLogs_label`;
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'SecurityDoEditPermissions', 'Permissions edited','eng','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'SecurityDoEditPermissions', 'Permissions edit failed','eng','failure');
