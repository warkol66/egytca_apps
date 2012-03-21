DELETE FROM `modules_label` WHERE `name` = 'orders' and `language` = 'eng';
OPTIMIZE TABLE `modules_label`;
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('orders', 'Orders', 'Manage orders', 'eng');
