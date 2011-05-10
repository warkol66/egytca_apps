DELETE FROM `security_module` WHERE `module` = 'positions';
INSERT INTO `security_module` ( `module` , `noCheckLogin` , `access` , `accessAffiliateUser` , `accessRegistrationUser` ) VALUES ('positions', '', '3', '0','0');
DELETE FROM `security_action` WHERE `module` = 'positions';
INSERT INTO `security_action` (`action`,`module`,`section`,`access`,`accessAffiliateUser`, `active` , `pair` , `noCheckLogin`, `accessRegistrationUser` ) VALUES ('positionsShow','positions','','1073741823','0','1','','','0' );
INSERT INTO `security_action` (`action`,`module`,`section`,`access`,`accessAffiliateUser`, `active` , `pair` , `noCheckLogin`, `accessRegistrationUser` ) VALUES ('positionsChartView','positions','','1073741823','0','1','','','0' );
