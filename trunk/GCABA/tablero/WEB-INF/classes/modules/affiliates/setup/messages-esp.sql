DELETE FROM `actionLogs_label` WHERE `action` LIKE 'Affiliates%' AND `language` = 'esp';
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'AffiliateUsersDoLogin', 'Usuario inicio de sesion exitoso','esp','success');
