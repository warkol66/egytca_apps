DELETE FROM `security_module` WHERE `module` = 'tablero';
INSERT INTO `security_module` ( `module` , `noCheckLogin` , `access` , `accessAffiliateUser` , `accessRegistrationUser` ) VALUES ('tablero', '', '3', '0','0');
DELETE FROM `security_action` WHERE `module` = 'tablero';
