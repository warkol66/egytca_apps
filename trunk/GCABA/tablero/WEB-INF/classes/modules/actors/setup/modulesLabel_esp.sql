DELETE FROM `modules_label` WHERE `name` = 'actors' and `language` = 'esp';
OPTIMIZE TABLE `modules_label`;
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('actors', 'Funcionarios', 'Administrador de funcionarios', 'esp');
