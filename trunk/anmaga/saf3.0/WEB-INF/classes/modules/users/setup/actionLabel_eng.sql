DELETE FROM `security_actionLabel` WHERE `action` LIKE 'Users%' AND `language` = 'eng';
OPTIMIZE TABLE `security_actionLabel`;
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersEdit', 'User edit', 'User edit', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersLogin', 'Users login', 'Users login', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersPasswordChange', 'Password modification', 'Password modification', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersPasswordRecovery', 'Password Recovery', 'Password Recovery', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersAutocompleteListX', 'Autocomplete users list', 'Autocomplete users list', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersCaptchaGeneration', 'Creates captcha', 'Creates captcha', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersDoActivate', 'User activation', 'User activation', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersDoActivateX', 'Activate user', 'Activate user', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersDoAddToGroup', '', '', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersDoAddToGroupX', 'Add user to group', 'Add user to group', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersDoDelete', 'Delete user', 'Delete user', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersDoDeleteFromGroupX', 'Remove user from group', 'Remove user from group', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersDoEditInfoX', 'Edit user info', 'Edit user info', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersDoLinkToSupplier', 'User link to supplier', 'User link to supplier', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersDoLogout', 'User logout', 'User logout', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersDoRemoveFromGroup', '', '', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersEditInfo', 'Edit User Info', 'Edit User Info', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersGroupsDoAddCategoryToGroup', 'Add category to group', 'Add category to group', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersGroupsDoDelete', 'Group deletion', 'Group deletion', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersGroupsDoEdit', 'Group edit', 'Group edit', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersGroupsDoRemoveCatFromGroup', 'Remove a category from group', 'Remove a category from group', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersGroupsList', 'Groups list', 'Groups list', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersLevelsDoDelete', 'Delete user level', 'Delete user level', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersLevelsDoEdit', 'Edit user level', 'Edit user level', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersLevelsList', 'Users level list', 'Users level list', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersList', 'Users list', 'Users list', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersLoginMaintenance', 'Users login under maintenance', 'Users login under maintenance', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersPasswordDoChangeForRecovery', 'Change password from recovery', 'Change password from recovery', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersPasswordRecoveryConfirmation', 'Confirm password recovery', 'Confirm password recovery', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersPasswordRecoverySendConfirmationRequest', 'Request Password recovery confirmation', 'Request Password recovery confirmation', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersPasswordResetX', 'Reset password', 'Reset password', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersValidationPasswordX', 'Verify current passwort in order to change it', 'Verify current passwort in order to change it', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersValidationUsernameX', 'Verify availability/validation of username', 'Verify availability/validation of username', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersWelcome', 'User welcome', 'User welcome', 'eng');
