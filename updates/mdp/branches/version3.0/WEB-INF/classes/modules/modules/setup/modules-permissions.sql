DELETE FROM `security_module` WHERE `module` = 'modules';
OPTIMIZE TABLE `security_module`;
INSERT INTO `security_module` ( `module` , `noCheckLogin` , `access` , `accessAffiliateUser` , `accessRegistrationUser` ) VALUES ('modules', '', '3', '0','0');
DELETE FROM `security_action` WHERE `module` = 'modules';
OPTIMIZE TABLE `security_action`;
