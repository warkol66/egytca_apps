DELETE FROM `security_module` WHERE `module` = 'actors';
INSERT INTO `security_module` ( `module` , `noCheckLogin` , `access` , `accessAffiliateUser` , `accessRegistrationUser` ) VALUES ('actors', '', '7', '0','0');
DELETE FROM `security_action` WHERE `module` = 'actors';
