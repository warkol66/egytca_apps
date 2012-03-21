DELETE FROM `actionLogs_label` WHERE `action` LIKE 'Users%' AND `language` = 'esp';
OPTIMIZE TABLE `actionLogs_label`;
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'UsersDoLogin', 'Inicio sesión de usuario exitoso','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'UsersDoLogin', 'Inicio sesión de usuario erroneo','esp','failure');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'UsersDoLogin', 'Inicio de sesión por primera vez','esp','successFirstLogin');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'UsersPasswordRecoverySendConfirmationRequest', 'Envio de contraseña para recuperación','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'UsersPasswordRecoverySendConfirmationRequest', 'No se puedo enviar contraseña para recuperación','esp','failure');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'UsersDoLogout', 'Fin de sesión exitoso','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'UsersDoEditInfoX', '','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'UsersPasswordDoChange', '','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'UsersPasswordDoChange', '','esp','changePassword');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'UsersPasswordDoChange', '','esp','failure');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'UsersDoDelete', 'Eliminación de usuario exitosa','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'UsersDoDelete', 'Eliminación de usuario fallida','esp','failure');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'UsersDoActivate', 'Activación de usuario exitosa','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'UsersDoActivate', 'Activación de usuario fallida','esp','failure');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'UsersGroupsDoEdit', 'Edición de grupo de usuarios exitosa','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'UsersGroupsDoEdit', 'Nombre de grupo de usuarios en blanco','esp','blankName');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'UsersGroupsDoAddCategoryToGroup', 'Agregado de categoría a grupo exitoso','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'UsersGroupsDoRemoveCatFromGroup', 'Eliminación de categoría a grupo exitoso','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'UsersGroupsDoDelete', 'Grupo de usuarios eliminado exitosamente','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'UsersGroupsDoDelete', 'Eliminación de grupo de usuarios fallida','esp','failure');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'UsersLevelsDoEdit', 'Edición de nivel de usuarios exitosa','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'UsersLevelsDoEdit', 'Nombre de nivel de usuario en blanco','esp','blankName');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'UsersLevelsDoDelete', 'Eliminación de nivel de usuario exitosa','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'UsersLevelsDoDelete', 'Eliminación de nivel de usuario fallida','esp','failure');
