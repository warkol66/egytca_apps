DELETE FROM `security_module` WHERE `module` = 'categories';
INSERT INTO `security_module` ( `module` , `noCheckLogin` , `access` , `accessAffiliateUser` , `accessRegistrationUser` ) VALUES ('categories', '', '2', '0','0');
DELETE FROM `security_action` WHERE `module` = 'categories';
