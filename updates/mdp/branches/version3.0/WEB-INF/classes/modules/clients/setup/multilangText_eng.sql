DELETE FROM `multilang_text` WHERE `moduleName` = 'clients' AND `languageCode` = 'eng';
OPTIMIZE TABLE `multilang_text`;
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('1', 'clients', 'eng','Clients');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('2', 'clients', 'eng','Client Users');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('3', 'clients', 'eng','Client');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('4', 'clients', 'eng','Branch');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('5', 'clients', 'eng','Branches');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('6', 'clients', 'eng','Owner');
