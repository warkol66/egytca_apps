DELETE FROM `multilang_text` WHERE `moduleName` = 'objectives' AND `languageCode` = 'esp';
OPTIMIZE TABLE `multilang_text`;
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('1', 'objectives', 'esp','Eje de Gesti�n');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('2', 'objectives', 'esp','Objetivo Estrat�gico');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('3', 'objectives', 'esp','Objetivo');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('4', 'objectives', 'esp','Ejes de Gesti�n');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('5', 'objectives', 'esp','Objetivos Estrat�gicos');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('6', 'objectives', 'esp','Objetivos');
