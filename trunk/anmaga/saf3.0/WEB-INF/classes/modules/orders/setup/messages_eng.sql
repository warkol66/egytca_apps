DELETE FROM `actionLogs_label` WHERE `action` LIKE 'Orders%' AND `language` = 'eng';
OPTIMIZE TABLE `actionLogs_label`;
