DELETE FROM `multilang_text` WHERE `moduleName` = 'clients' AND `languageCode` = 'sys';
OPTIMIZE TABLE `multilang_text`;
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('2', 'clients', 'sys','Client Users');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('1', 'clients', 'sys','Clients');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('3', 'clients', 'sys','Client');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('4', 'clients', 'sys','Branch');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('5', 'clients', 'sys','Branches');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('6', 'clients', 'sys','Owner');
