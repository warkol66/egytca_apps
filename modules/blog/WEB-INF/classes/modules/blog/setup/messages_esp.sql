DELETE FROM `actionLogs_label` WHERE `action` LIKE 'Blog%' AND `language` = 'esp';
OPTIMIZE TABLE `actionLogs_label`;
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'BlogSendToEmailX', 'Entrada enviada exitosamente','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'BlogSendToEmailX', 'La entrada no se pudo enviar','esp','failure');
