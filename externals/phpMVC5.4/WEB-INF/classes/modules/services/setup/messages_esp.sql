DELETE FROM `actionLogs_label` WHERE `action` LIKE 'services%' AND `language` = 'esp';
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'ServicesMultilangLanguagesDoEdit', 'Texto editado exitosamente','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'ServicesMultilangLanguagesDoEdit', 'Error al guardar el texto','esp','failure');
