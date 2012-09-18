DELETE FROM `actionLogs_label` WHERE `action` LIKE 'Common%' AND `language` = 'esp';
OPTIMIZE TABLE `actionLogs_label`;
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'CommonDoLogin', 'Usuario inició sesión satisfactoriamente','esp','successUser');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'CommonDoLogin', 'Primer ingreso del usuario','esp','successUserFirstLogin');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'CommonDoLogin', 'Error','esp','failure');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'CommonDoLogin', 'No se pudo ingresar, faltaron datos','esp','failureMissingData');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'CommonDoLogin', 'Usuario inició sesión satisfactoriamente','esp','successAffiliateUsers');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'CommonDoLogin', 'Error en ingreso del usuario','esp','failureRedirectUserLogin');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'CommonPasswordRecoverySendConfirmationRequest', 'Se envió confirmación para recuperar contraseña','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'CommonPasswordRecoverySendConfirmationRequest', 'No se pudo enviar  confirmación para recuperar contraseña','esp','failure');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'CommonDoLogout', 'usuario terminó la sesión','esp','success');
INSERT INTO `actionLogs_label` (`action`, `label`, `language`, `forward`) VALUES ( 'CommonActionLogsDoPurge', 'Se eliminaron registros históricos','esp','success');
