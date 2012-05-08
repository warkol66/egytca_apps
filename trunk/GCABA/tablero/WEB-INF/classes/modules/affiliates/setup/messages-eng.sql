DELETE FROM `actionLogs_label` WHERE `action` LIKE 'Affiliates%' AND `language` = 'eng';
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'AffiliateUsersDoLogin', 'User login successful','eng','success');
