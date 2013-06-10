DELETE FROM `actionLogs_label` WHERE `action` LIKE 'multilang%' AND `language` = 'esp';
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'MultilangLanguagesDoEdit', 'Texto editado exitosamente','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'MultilangLanguagesDoEdit', 'Error al guardar el texto','esp','failure');
