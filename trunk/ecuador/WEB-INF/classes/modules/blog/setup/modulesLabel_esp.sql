DELETE FROM `modules_label` WHERE `name` = 'blog' and `language` = 'esp';
OPTIMIZE TABLE `modules_label`;
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('blog', 'BlaBlaBla', 'Modulo de Blog', 'esp');
