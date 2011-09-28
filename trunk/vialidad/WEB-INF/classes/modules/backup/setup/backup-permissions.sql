DELETE FROM `security_module` WHERE `module` = 'backup';
OPTIMIZE TABLE `security_module`;
INSERT INTO `security_module` ( `module` , `noCheckLogin` , `access` , `accessAffiliateUser` , `accessRegistrationUser` ) VALUES ('backup', '', '3', '0','0');
DELETE FROM `security_action` WHERE `module` = 'backup';
OPTIMIZE TABLE `security_action`;
