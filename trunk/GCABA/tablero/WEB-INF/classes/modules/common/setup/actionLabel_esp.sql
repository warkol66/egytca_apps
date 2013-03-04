DELETE FROM `security_actionLabel` WHERE `action` LIKE 'Common%' AND `language` = 'esp';
OPTIMIZE TABLE `security_actionLabel`;
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonActionLogsPurge', 'Eliminar registros históricos', 'Elimina registros históricos', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonAlertsSubscriptionsEdit', 'Editar suscripción de alertas', 'Edita suscripción de alertas', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonConfigEdit', 'Modificar estructura de configuración', 'Modifica estructura de configuración', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonConfigSet', 'Modificar valores de configuración', 'Modifica valores de configuración', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonLogin', 'Ingresar usuarios al sistema', 'Ingreso de usuarios al sistema', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonInternalMailsEdit', 'Editar correos internos', 'Edita correos internos', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonMenuItemsEdit', 'Editar elementos del menú', 'Edita elementos del menú', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonSchedulesSubscriptionsEdit', 'Editar suscripción programada', 'Edita suscripción programada', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonActionLogsList', 'Ver listado de histórico de operaciones', 'Muestra listado de histórico de operaciones', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonAlertsSubscriptionsDoAddUserX', 'Agregar usuario a suscripción de alerta', 'Agrega usuario a suscripción de alerta', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonAlertsSubscriptionsDoDelete', 'Eliminar suscripción de alerta', 'Elimina suscripción de alerta', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonAlertsSubscriptionsDoDeleteUserX', 'Eliminar usuario de suscripción de alerta', 'Elimina usuario de suscripción de alerta', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonAlertsSubscriptionsGetEntityFields', 'Obtener campos para fijar alertas', 'Obtiene campos para fijar alertas', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonAlertsSubscriptionsList', 'Listar suscripciones de alertas disponibles', 'Lista de suscripciones de alertas disponibles', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonAutocompleteJQueryListX', 'Autocompletar genérico en jQuery', 'Opera un autocompletar genérico con jQuery', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonAutocompleteListX', 'Autocompletar genérico ', 'Opera un autocompletar genérico', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonCaptchaGeneration', 'Generar imagen de seguridad', 'Genera imagen de seguridad', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonChecksum', 'Generar checksum de verificación de tablas de BD', 'Genera checksum de verificación de tablas de BD', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonConfigView', 'Ver valores de configuración', 'Muestra valores de configuración', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonDoEditFieldX', 'Editar (in place) en el lugar campos', 'Edita valores de campos "en el lugar (in place)', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonDoEditX', 'Acción genérica de guardado de datos', 'Guardado genérico de información', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonDoLogout', 'Salir del sistema', 'Salida dle sistema', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonGenerateJs', 'Generar archivo JavaScript', 'Genera archivo JavaScript', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonImage', 'Generar imágen de verificación', 'Genera imágen de verificación', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonIndex', 'Redireccionar al indice del sistema', 'Redireccionamiento al indice del sistema', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonInternalMailsDoDeleteX', 'Eliminar correo interno', 'Elimina correo interno', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonInternalMailsDoMarkAsReadX', 'Marcar correo interno como leido', 'Marca correo interno como leido', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonInternalMailsList', 'Listar mensajes de correo internos', 'Lista de mensajes de correo internos', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonInternalMailsView', 'Ver mensaje de correo interno', 'Muestra mensaje de correo interno', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonInternalMailsViewX', 'Ver mensaje de correo interno', 'Muestra mensaje de correo interno', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonMaintenance', 'Redireccionar al modo en mantenimiento', 'Redireccionamiento al modo en mantenimiento', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonMeasureUnitsDoDeleteX', 'Eliminar unidades de medida', 'Elimina unidad de medida', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonMeasureUnitsDoEditX', 'Alta/Modificación de unidades de medida', 'Alta/Modifica unidades de medida', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonMeasureUnitsList', 'Listar unidades de medida', 'Listado de unidades de medida', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonMenuItemsActionsAutocompleteListX', 'Mostrar opciones disponible con autocompletar', 'Ayuda para autocompletar con acciones existentes', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonMenuItemsDoDeleteX', 'Eliminar item del menú', 'Elimina item del menú', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonMenuItemsDoEditOrderX', 'Cambiar el orden de items del menú', 'Cambiar el orden de items del menú', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonMenuItemsGetActionInfoX', 'Obtener información para generación de menu', 'Obtener información para generación de menu', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonMenuItemsList', 'Listado de elementos dle menu', 'Listado de elementos dle menu', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonMenuItemsShow', 'Mostrar menu', 'Muestra menu', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonNestedSetDoOrderByParentX', 'Ordenar por padre en elementos anidados', 'Ordena elementos en base al padre de elementos anidados', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonNestedSetOrderByParent', 'Ordenar por padre  en elementos anidados', 'Ordena elementos en base al padre de elementos anidados', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonPasswordDoRecover', 'Recuperar contraseña', 'Confirma recuperaciónd e contraseña de usuario', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonPasswordDoSetFromRecovery', 'Cambiar contraseña de usuario luego de recuperar', 'Cambia contraseña de usuario luego de recuperar', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonPasswordRecovery', 'Recuper contraseña', 'Recupe contraseña de usuario', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonPasswordRecoveryDoRequest', 'Solicitar recuperación de contraeña', 'Solicita recuperación de contraeña d eusuario', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonRelationsFinder', 'Buscar relaciones de tablas', 'Busca relaciones entre tablas', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonSchedulesSubscriptionsDoAddUserX', 'Agregar usuario a suscripción de agenda', 'Agrega usuario a suscripción de agenda', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonSchedulesSubscriptionsDoDelete', 'Eliminar suscripción de agenda', 'Elimina suscripción de agenda', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonSchedulesSubscriptionsDoDeleteUserX', 'Eliminar usuario de suscripción', '', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonSchedulesSubscriptionsGetEntityFields', 'Obtener campos para suscripción de agenda', 'Obtiene campos para suscripción de agenda', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonSchedulesSubscriptionsList', 'Listar alertas de suscripción de agenda', 'Lista de alertas de suscripción de agenda', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonSearchActorListX', 'Buscador genérico de autocompletar para funcionarios', 'Busca funcionarios desde lugar genérico', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonSearchEntityListX', 'Listar posibles entidades del sistema para relaciones', 'Listado de posibles entidades del sistema para relaciones', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonSearchHeadlineListX', 'Buscador de titulares', 'Busca titulares', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonSearchIssueListX', 'Buscador de asuntos', 'Busca asuntos', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonSendAlerts', 'Enviar alertas de vencimientos', 'Envío de alertas de vencimientos', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonSendSchedules', 'Enviar agenda de vencimientos', 'Envío de agenda de vencimientos', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonSetLanguage', 'Configurar idioma de la aplicación', 'Configura el idioma de la aplicación', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonTemplatePublic', 'Mostrar un external público', 'Muestra un external público', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonTutorialView', 'Ver los tutoriales', 'Muestra un tutorial', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CommonWelcome', 'Acción de bienvenida del usuario', 'Muestra pantalla de bienvenida del usuario', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('Js', 'Entregar archivos de javascript', 'Entrega archivos de javascript', 'esp');
