DELETE FROM `security_actionLabel` WHERE `action` LIKE 'Users%' AND `language` = 'esp';
OPTIMIZE TABLE `security_actionLabel`;
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersLogin', 'Ingresar al sistema', 'Ingreso al sistema', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersEdit', 'Modificar Información del Usuario', 'Modifica Información del Usuario', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersPasswordChange', 'Modificar contraseña', 'Modificación de contraseña', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersDoLinkToSupplier', 'Enlazar usuario a proveedor', 'Asocia usuario a proveedor', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersEditInfo', 'Modificar Información del Usuario', 'Modifica Información del Usuario', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersDoDeleteFromGroupX', 'Eliminar usuario de grupo', 'Elimina usuario de grupo', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersDoEditInfoX', 'Editar información de Usuario', 'Edita información de Usuario', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersLoginMaintenance', 'Ingresar al sistema en mantenimiento', 'Ingreso al sistema en mantenimiento', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersLevelsDoDelete', 'Eliminar nivel de usuario', 'Elimina nivel de usuario', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersGroupsDoAddCategoryToGroup', 'Agregar categoría a grupo', 'Agrega categoría a grupo', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersDoLogout', 'Salir del sistema', 'Salida del sistema', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersLevelsDoEdit', 'Editar nivel de usuario', 'Edita nivel de usuario', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersDoAddToGroupX', 'Agregar usuario a grupo', 'Agrega usuario a grupo', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersPasswordDoRecover', 'Recuperar contraseña de usuario', 'Recupera contraseña de usuario', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersGroupsDoEdit', 'Editar grupo de usuarios', 'Edita grupo de usuarios', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersLevelsList', 'Listar niveles de usuario', 'Listado de niveles de usuario', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersDoRemoveFromGroup', 'Elimiminar un usuario de un grupo', 'Elimimina un usuario de un grupo', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersList', 'Listar usuarios', 'Lista de usuarios', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersGroupsDoDelete', 'Eliminar grupo', 'Elimina grupo', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersDoDelete', 'Eliminar usuario', 'Elimina usuario', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersDoActivateX', 'Activar usuario', 'Activa usuario', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersValidationPasswordX', 'Verificar contraseña actual para su modificación', 'Verifica contraseña actual para su modificación', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersValidationUsernameX', 'Verificar validez/disponibilidad de nombre de usuario', 'Verifica validez/disponibilidad de nombre de usuario', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersPasswordDoChangeForRecovery', 'Cambiar contraseña recuperada', 'Cambia contraseña recuperada', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersPasswordResetX', 'Resetear contraseña de usuarios', 'Resetea contraseña de usuarios', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersGroupsList', 'Listar grupos de usuarios', 'Lista de grupos de usuarios', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersDoActivate', 'Activar usuario', 'Activación de usuario', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersAutocompleteListX', 'Autocompletar usuarios', 'Listado para autocompletar usuarios', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersWelcome', 'Página de bienvenida al usuario', 'Página de bienvenida al usuario', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersPasswordRecoveryDoRequest', 'Solicitar recuperación contraseña de usuario', 'Solicita recuperación contraseña de usuario', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersPasswordRecovery', 'Recuperar contraseña de usuario', 'Recupera contraseña de usuario', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersGroupsDoRemoveCatFromGroup', 'Eliminar categoría de un grupo', 'Elimina categoría de un grupo', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('UsersPasswordRecoveryConfirmation', 'Confirmar recupero de contraseña', 'Confirma recupero de contraseña', 'esp');