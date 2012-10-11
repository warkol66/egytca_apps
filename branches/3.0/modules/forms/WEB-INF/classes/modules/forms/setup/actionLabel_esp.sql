DELETE FROM `security_actionLabel` WHERE `action` LIKE 'Forms%' AND `language` = 'esp';
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('FormsProcessedFormsEdit', 'Editar respuesta de formulario', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('FormsFormsEdit', 'Editar formulario', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('FormsProcessedFormView', 'Ver respuesta de formulario', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('FormsFormsDoDelete', 'Eliminar formulario', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('FormsProcessedFormsDoDelete', 'Eliminar respuesta de formulario', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('FormsDoProcess', 'Procesar información de formulario', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('FormsCaptchaGeneration', 'Generar imagen de seguridad', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('FormsFormsList', 'Lista de formularios', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('FormsProcessedFormsList', 'Lista de respuestas', 'esp');