DELETE FROM `security_module` WHERE `module` = 'actors';
OPTIMIZE TABLE `security_module`;
INSERT INTO `security_module` ( `module` , `noCheckLogin` , `access` , `accessAffiliateUser` , `accessRegistrationUser` ) VALUES ('actors', '', '3', '0','0');
DELETE FROM `security_action` WHERE `module` = 'actors';
OPTIMIZE TABLE `security_action`;
INSERT INTO `security_action` (`action`,`module`,`section`,`access`,`accessAffiliateUser`, `active` , `pair` , `noCheckLogin`, `accessRegistrationUser` ) VALUES ('actorsAutocompleteListX','actors','','1073741823','0','1','','','0' );
