DELETE FROM `multilang_text` WHERE `moduleName` = 'issues' AND `languageCode` = 'eng';
OPTIMIZE TABLE `multilang_text`;
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('1', 'issues', 'eng','Issues');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('2', 'issues', 'eng','Issue');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('3', 'issues', 'eng','issues');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('4', 'issues', 'eng','issue');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('5', 'issues', 'eng','Emergent');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('6', 'issues', 'eng','Growing');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('7', 'issues', 'eng','Stable');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('8', 'issues', 'eng','Plateau');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('9', 'issues', 'eng','Declining');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('10', 'issues', 'eng','Closed');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('11', 'issues', 'eng','Higly positive');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('12', 'issues', 'eng','Positive');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('13', 'issues', 'eng','Neutral');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('14', 'issues', 'eng','Negative');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('15', 'issues', 'eng','Highly negative');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('16', 'issues', 'eng','Low');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('17', 'issues', 'eng','Medium');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('18', 'issues', 'eng','High');
