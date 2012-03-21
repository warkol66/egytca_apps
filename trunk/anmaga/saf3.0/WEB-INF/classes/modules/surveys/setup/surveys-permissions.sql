DELETE FROM `security_module` WHERE `module` = 'surveys';
INSERT INTO `security_module` ( `module` , `noCheckLogin` , `access` , `accessAffiliateUser` , `accessRegistrationUser` ) VALUES ('surveys', '', '3', '0','0');
DELETE FROM `security_action` WHERE `module` = 'surveys';
INSERT INTO `security_action` (`action`,`module`,`section`,`access`,`accessAffiliateUser`, `active` , `pair` , `noCheckLogin`, `accessRegistrationUser` ) VALUES ('surveysDisplayBar','surveys','','0','0','1','','1','0' );
INSERT INTO `security_action` (`action`,`module`,`section`,`access`,`accessAffiliateUser`, `active` , `pair` , `noCheckLogin`, `accessRegistrationUser` ) VALUES ('surveysRespondX','surveys','','0','0','1','','1','0' );
INSERT INTO `security_action` (`action`,`module`,`section`,`access`,`accessAffiliateUser`, `active` , `pair` , `noCheckLogin`, `accessRegistrationUser` ) VALUES ('surveysShow','surveys','','0','0','1','','1','0' );
INSERT INTO `security_action` (`action`,`module`,`section`,`access`,`accessAffiliateUser`, `active` , `pair` , `noCheckLogin`, `accessRegistrationUser` ) VALUES ('surveysResults','surveys','','0','0','1','','1','0' );
