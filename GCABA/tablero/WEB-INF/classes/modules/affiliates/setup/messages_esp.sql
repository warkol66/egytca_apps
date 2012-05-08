DELETE FROM `actionLogs_label` WHERE `action` LIKE 'Affiliates%' AND `language` = 'esp';
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'AffiliatesUsersDoLogin', 'Inició la sesión correctamente','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'AffiliatesUsersDoLogin', 'Error en los datos de ingreso','esp','failure-unified');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'AffiliatesUsersDoLogin', 'Error en los datos de ingreso','esp','failure');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'AffiliatesUsersDoLogout', 'Terminó la sesión','esp','success-unified');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'AffiliatesUsersDoLogout', 'Terminó la sesión','esp','success');
