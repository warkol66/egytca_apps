DELETE FROM `actionLogs_label` WHERE `action` LIKE 'news%' AND `language` = 'esp';
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'NewsArticlesSendToEmailX', 'Novedad enviada exitosamente','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'NewsArticlesSendToEmailX', 'Novedad no se pudo enviar','esp','failure');
