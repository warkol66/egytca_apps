DELETE FROM `security_actionLabel` WHERE `action` LIKE 'Content%' and `language` = '';
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('ContentEdit', 'Edit content', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('ContentShow', 'Show content', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('ContentList', 'List content', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('ContentDoDelete', 'Delete content', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('ContentLanguageDoDelete', 'Delete content language', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('ContentDoEditOrderX', 'Change content order', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('ContentLanguagesList', 'List content languages ', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('ContentLanguageActivate', 'Activate content language', 'eng');
