DELETE FROM `security_actionLabel` WHERE `action` LIKE 'Common%' AND `language` = 'esp';
OPTIMIZE TABLE `security_actionLabel`;
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('CommonConfigEdit', 'Modificar estructura de configuración', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('CommonActionLogsPurge', 'Eliminar registros históricos', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('CommonConfigSet', 'Modificar valores de configuración', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('CommonLogin', 'Ingreso de usuariso al sistema', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('CommonMenuItemsEdit', 'Editar elementos del menú', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('CommonMenuItemsShow', 'Mostrar menu', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('CommonActionLogsList', 'Ver listado de histórico de operaciones', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('CommonMenuItemsGetActionInfoX', 'Obtener información para generación de menu', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('CommonTemplatePublic', 'Muestra un external público', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('CommonSetLanguage', 'Condifura el idioma de la aplicación', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('CommonGraph', '', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('CommonJs', 'Genera archivo de JavaScript', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('CommonMenuItemsList', 'Listado de elementos dle menu', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('CommonMenuItemsDoEditOrderX', 'Cambiar el orden de items del menú', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('CommonMaintenance', 'Redireccionamiento de Sistema en Mantenimiento', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('CommonMenuItemsActionsAutocompleteListX', 'Ayuda para autocompletar con acciones existentes', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('CommonIndex', 'Redireccionamiento al indice', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('CommonMap', '', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('CommonWelcome', 'Acción de bienvenida del usuario', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('Js', 'Entregar archivos de javascript', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('CommonDoLogout', 'Salida dle sistema', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('CommonMenuItemsDoDeleteX', 'Eliminar item del menú', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('CommonGenerateJs', 'Generar archivo JavaScript', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('CommonConfigView', 'Ver valores de configuración', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('CommonCaptchaGeneration', 'Generar imagen de seguridad', 'esp');
