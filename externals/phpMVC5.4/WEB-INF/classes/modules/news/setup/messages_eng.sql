DELETE FROM `actionLogs_label` WHERE `action` LIKE 'news%' AND `language` = 'eng';
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'NewsArticlesSendToEmailX', 'News sent sucessfully','eng','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'NewsArticlesSendToEmailX', 'Error sending news','eng','failure');
