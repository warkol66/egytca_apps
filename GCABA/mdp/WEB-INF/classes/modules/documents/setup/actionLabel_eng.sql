DELETE FROM `security_actionLabel` WHERE `action` LIKE 'Documents%' AND `language` = 'eng';
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('DocumentsEdit', 'Upload or update documents', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('DocumentsKeyWordEdit', 'Edit key word', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('DocumentsList', 'Shows the documents available in the system', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('DocumentsCategoriesList', 'Displays documents by categories', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('DocumentsBase', 'Common functions', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('DocumentsDoDownload', 'Allows documents download', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('DocumentsDoDeleteX', 'Delete document', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('DocumentsDoDelete', 'Deletes documents', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('DocumentsShow', 'Public documents list', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('DocumentsKeyWordList', 'List key words', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('DocumentsKeyWordDoDelete', 'Delete key word', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('DocumentsUpload', 'Upload document', 'eng');
