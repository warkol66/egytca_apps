DELETE FROM `security_module` WHERE `module` = 'security';
OPTIMIZE TABLE `security_module`;
INSERT INTO `security_module` ( `module` , `noCheckLogin` , `access` , `accessAffiliateUser` , `accessRegistrationUser` ) VALUES ('security', '', '3', '0','0');
DELETE FROM `security_action` WHERE `module` = 'security';
OPTIMIZE TABLE `security_action`;
INSERT INTO `security_action` (`action`,`module`,`section`,`access`,`accessAffiliateUser`, `active` , `pair` , `noCheckLogin`, `accessRegistrationUser` ) VALUES ('securityNoPermission','security','','0','0','1','','1','0' );
