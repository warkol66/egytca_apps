DELETE FROM `security_module` WHERE `module` = 'blog';
OPTIMIZE TABLE `security_module`;
INSERT INTO `security_module` ( `module` , `noCheckLogin` , `access` , `accessAffiliateUser` , `accessRegistrationUser` ) VALUES ('blog', '', '0', '0','0');
DELETE FROM `security_action` WHERE `module` = 'blog';
OPTIMIZE TABLE `security_action`;
INSERT INTO `security_action` (`action`,`module`,`section`,`access`,`accessAffiliateUser`, `active` , `pair` , `noCheckLogin`, `accessRegistrationUser` ) VALUES ('blogCommentsChangeStatusX','blog','','5','0','1','','','0' );
INSERT INTO `security_action` (`action`,`module`,`section`,`access`,`accessAffiliateUser`, `active` , `pair` , `noCheckLogin`, `accessRegistrationUser` ) VALUES ('blogCommentsEdit','blog','','7','0','1','blogCommentsDoEdit','','0' );
