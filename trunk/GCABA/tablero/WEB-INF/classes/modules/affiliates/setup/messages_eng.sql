DELETE FROM `actionLogs_label` WHERE `action` LIKE 'Affiliates%' AND `language` = 'eng';
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'AffiliatesUsersDoLogin', 'Succesfuly session started','eng','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'AffiliatesUsersDoLogin', 'Login failure','eng','failure-unified');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'AffiliatesUsersDoLogin', 'Login failure','eng','failure');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'AffiliatesUsersDoLogout', 'Session ended','eng','success-unified');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'AffiliatesUsersDoLogout', 'Session ended','eng','success');
