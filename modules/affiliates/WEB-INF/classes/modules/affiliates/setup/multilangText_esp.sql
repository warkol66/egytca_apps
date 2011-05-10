DELETE FROM `multilang_text` WHERE `moduleName` = 'affiliates' AND `languageCode` = 'esp';
OPTIMIZE TABLE `multilang_text`;
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('1', 'affiliates', 'esp','Afiliados');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('2', 'affiliates', 'esp','Usuarios de Afiliados');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('3', 'affiliates', 'esp','Afiliado');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('4', 'affiliates', 'esp','Sucursal');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('5', 'affiliates', 'esp','Sucursales');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('6', 'affiliates', 'esp','Usuario Administrador');
