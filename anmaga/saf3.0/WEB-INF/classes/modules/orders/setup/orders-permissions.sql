DELETE FROM `security_module` WHERE `module` = 'orders';
OPTIMIZE TABLE `security_module`;
INSERT INTO `security_module` ( `module` , `noCheckLogin` , `access` , `accessAffiliateUser` , `accessRegistrationUser` ) VALUES ('orders', '', '1073741823', '1073741823','0');
DELETE FROM `security_action` WHERE `module` = 'orders';
OPTIMIZE TABLE `security_action`;
