DELETE FROM `security_module` WHERE `module` = 'segmentation';
INSERT INTO `security_module` ( `module` , `noCheckLogin` , `access` , `accessAffiliateUser` , `accessRegistrationUser` ) VALUES ('segmentation', '', '3', '0','0');
DELETE FROM `security_action` WHERE `module` = 'segmentation';
