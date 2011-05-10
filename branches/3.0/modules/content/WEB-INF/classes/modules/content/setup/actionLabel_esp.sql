DELETE FROM `security_actionLabel` WHERE `action` LIKE 'Content%' and `language` = '';
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('ContentEdit', 'Editar contenido', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('ContentShow', 'Mostrar contenidos', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('ContentList', 'Listado de contenidos', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('ContentDoDelete', 'Eliminar contenido', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('ContentLanguageDoDelete', 'Eliminar idioma de contenido', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('ContentDoEditOrderX', 'Modificar orden de contenido', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('ContentLanguagesList', 'Listado de idiomas disponibles', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('ContentLanguageActivate', 'Activar idioma', 'esp');
