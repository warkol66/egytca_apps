DELETE FROM `security_module` WHERE `module` = 'studycases';
OPTIMIZE TABLE `security_module`;
INSERT INTO `security_module` ( `module` , `noCheckLogin` , `access` , `accessAffiliateUser` , `accessRegistrationUser` ) VALUES ('studycases', '', '7', '0','0');
DELETE FROM `security_action` WHERE `module` = 'studycases';
OPTIMIZE TABLE `security_action`;
INSERT INTO `security_action` (`action`,`module`,`section`,`access`,`accessAffiliateUser`, `active` , `pair` , `noCheckLogin`, `accessRegistrationUser` ) VALUES ('studycasesView','studycases','','0','0','1','','1','0' );
INSERT INTO `security_action` (`action`,`module`,`section`,`access`,`accessAffiliateUser`, `active` , `pair` , `noCheckLogin`, `accessRegistrationUser` ) VALUES ('studycasesShow','studycases','','0','0','1','','1','0' );
