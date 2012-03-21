DELETE FROM `security_actionLabel` WHERE `action` LIKE 'Security%' AND `language` = 'eng';
OPTIMIZE TABLE `security_actionLabel`;
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('SecurityEditPermissions', 'Edit permissions', 'Edit permissions', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('NoPermission', 'No permission on the requested action', 'No permission on the requested action', 'eng');
