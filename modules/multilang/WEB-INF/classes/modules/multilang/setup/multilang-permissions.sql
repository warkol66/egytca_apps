DELETE FROM `security_module` WHERE `module` = 'multilang';
INSERT INTO `security_module` ( `module` , `noCheckLogin` , `access` , `accessAffiliateUser` , `accessRegistrationUser` ) VALUES ('multilang', '', '2', '0','0');
DELETE FROM `security_action` WHERE `module` = 'multilang';
INSERT INTO `security_action` (`action`,`module`,`section`,`access`,`accessAffiliateUser`, `active` , `pair` , `noCheckLogin`, `accessRegistrationUser` ) VALUES ('multilangTextsList','multilang','','3','0','1','','','0' );
