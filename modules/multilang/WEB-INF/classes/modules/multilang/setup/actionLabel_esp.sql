DELETE FROM `security_actionLabel` WHERE `action` LIKE 'Multilang%' and `language` = '';
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('MultilangLanguagesEdit', 'Modificar idiomas', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('MultilangTextsEdit', 'Editar texto en idiomas disponibles', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('MultilangTextsDump', 'Exportar archivos de idiomas', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('MultilangTextsEditBulk', 'Editar múltiples textos', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('MultilangTextsList', 'Lista de mensajes en idiomas disponibles', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('MultilangLanguagesList', 'Lista de idiomas disponibles', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('MultilangLanguagesDoDelete', 'Eliminar idioma', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('MultilangTextsDoDelete', 'Editar texto', 'esp');
