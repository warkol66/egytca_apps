DELETE FROM `security_module` WHERE `module` = 'registration';
INSERT INTO `security_module` ( `module` , `access` , `accessAffiliateUser` , `accessRegistrationUser` ) VALUES ('registration', '0', '0','0');

DELETE FROM `security_action` WHERE `module` = 'registration';
INSERT INTO `security_action` (`action`,`module`,`section`,`access`,`accessAffiliateUser`, `active` , `pair` , `noCheckLogin`, `accessRegistrationUser` ) VALUES ('registrationCaptchaGeneration','registration','','0','0','1','Array','1','0' );
INSERT INTO `security_action` (`action`,`module`,`section`,`access`,`accessAffiliateUser`, `active` , `pair` , `noCheckLogin`, `accessRegistrationUser` ) VALUES ('registrationDoDelete','registration','','7','0','1','Array','','0' );
INSERT INTO `security_action` (`action`,`module`,`section`,`access`,`accessAffiliateUser`, `active` , `pair` , `noCheckLogin`, `accessRegistrationUser` ) VALUES ('registrationList','registration','','7','0','1','Array','','0' );
INSERT INTO `security_action` (`action`,`module`,`section`,`access`,`accessAffiliateUser`, `active` , `pair` , `noCheckLogin`, `accessRegistrationUser` ) VALUES ('registrationDoLogout','registration','','0','0','1','Array','1','0' );
INSERT INTO `security_action` (`action`,`module`,`section`,`access`,`accessAffiliateUser`, `active` , `pair` , `noCheckLogin`, `accessRegistrationUser` ) VALUES ('registrationDoHashVerification','registration','','0','0','1','Array','1','0' );
INSERT INTO `security_action` (`action`,`module`,`section`,`access`,`accessAffiliateUser`, `active` , `pair` , `noCheckLogin`, `accessRegistrationUser` ) VALUES ('registrationEdit','registration','','7','0','1','registrationDoEdit','1','0' );
INSERT INTO `security_action` (`action`,`module`,`section`,`access`,`accessAffiliateUser`, `active` , `pair` , `noCheckLogin`, `accessRegistrationUser` ) VALUES ('registrationLogin','registration','','0','0','1','registrationDoLogin','1','0' );
INSERT INTO `security_action` (`action`,`module`,`section`,`access`,`accessAffiliateUser`, `active` , `pair` , `noCheckLogin`, `accessRegistrationUser` ) VALUES ('registrationPasswordRecovery','registration','','7','0','1','registrationDoPasswordRecovery','1','0' );
