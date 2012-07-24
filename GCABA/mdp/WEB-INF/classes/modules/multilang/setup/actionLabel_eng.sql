DELETE FROM `security_actionLabel` WHERE `action` LIKE 'Multilang%' and `language` = '';
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('MultilangLanguagesEdit', 'Edit languages', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('MultilangTextsEdit', 'Edit text in available languages', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('MultilangTextsDump', 'Export language files', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('MultilangTextsEditBulk', 'Bulk text language edit', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('MultilangTextsList', 'List language texts', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('MultilangLanguagesList', 'List available languages', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('MultilangLanguagesDoDelete', 'Delete language', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('MultilangTextsDoDelete', 'Edit texts', 'eng');
