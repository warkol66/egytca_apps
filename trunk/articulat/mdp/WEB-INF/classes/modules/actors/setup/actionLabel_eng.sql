DELETE FROM `security_actionLabel` WHERE `action` LIKE 'Actors%' AND `language` = 'eng';
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('ActorsEditX', 'Create new Actor', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('ActorsEdit', 'Create/Edit new Actor', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('ActorsDoDelete', 'Delete Actor', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('ActorsList', 'Actors List', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('ActorsAutocompleteListX', 'Autocomplete actors list', 'eng');
