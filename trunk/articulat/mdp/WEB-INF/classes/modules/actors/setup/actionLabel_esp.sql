DELETE FROM `security_actionLabel` WHERE `action` LIKE 'Actors%' AND `language` = 'esp';
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('ActorsEditX', 'Crear nuevo funcionario', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('ActorsEdit', 'Crear/Editar Funcionario', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('ActorsDoDelete', 'Eliminar Funcionario', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('ActorsList', 'Listado de Funcionarios', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('ActorsAutocompleteListX', 'Listado funcionario con autocompletar', 'esp');
