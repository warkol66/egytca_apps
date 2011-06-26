DELETE FROM `modules_label` WHERE `name` = 'affiliates' and `language` = 'eng';
OPTIMIZE TABLE `modules_label`;
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('affiliates', 'Affiliates', 'Affiliates management', 'eng');
