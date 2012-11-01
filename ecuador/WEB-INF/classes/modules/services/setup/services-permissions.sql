DELETE FROM `security_module` WHERE `module` = 'services';
OPTIMIZE TABLE `security_module`;
INSERT INTO `security_module` ( `module` , `noCheckLogin` , `access` , `accessAffiliateUser` , `accessRegistrationUser` ) VALUES ('services', '', '3', '0','0');
DELETE FROM `security_action` WHERE `module` = 'services';
OPTIMIZE TABLE `security_action`;
