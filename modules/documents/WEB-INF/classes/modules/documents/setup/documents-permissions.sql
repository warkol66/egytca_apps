DELETE FROM `security_module` WHERE `module` = 'documents';
INSERT INTO `security_module` ( `module` , `noCheckLogin` , `access` , `accessAffiliateUser` , `accessRegistrationUser` ) VALUES ('documents', '', '1073741823', '0','0');
DELETE FROM `security_action` WHERE `module` = 'documents';
INSERT INTO `security_action` (`action`,`module`,`section`,`access`,`accessAffiliateUser`, `active` , `pair` , `noCheckLogin`, `accessRegistrationUser` ) VALUES ('documentsBase','documents','','0','0','1','','1','0' );
INSERT INTO `security_action` (`action`,`module`,`section`,`access`,`accessAffiliateUser`, `active` , `pair` , `noCheckLogin`, `accessRegistrationUser` ) VALUES ('documentsShow','documents','','0','0','1','','1','0' );
