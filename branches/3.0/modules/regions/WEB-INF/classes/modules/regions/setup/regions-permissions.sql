DELETE FROM `security_module` WHERE `module` = 'regions';
INSERT INTO `security_module` ( `module` , `noCheckLogin` , `access` , `accessAffiliateUser` , `accessRegistrationUser` ) VALUES ('regions', '', '3', '0','0');
DELETE FROM `security_action` WHERE `module` = 'regions';
