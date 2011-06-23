DELETE FROM `actionLogs_label` WHERE `action` LIKE 'Security%' AND `language` = 'esp';
OPTIMIZE TABLE `actionLogs_label`;
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'SecurityDoEditPermissions', 'Se modificaron los permisos','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'SecurityDoEditPermissions', 'No se pudo guardar el cambio de permisos','esp','failure');
