DELETE FROM `security_actionLabel` WHERE `action` LIKE 'Regions%' AND `language` = 'eng';
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('RegionsEdit', 'Add/Edit regions', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('RegionsTimezoneEdit', 'Add/Edit timezones', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('RegionsDoDelete', 'Delete regions', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('RegionsGetAllParentsByRegionX', 'Gets all potential parents of a region', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('RegionsList', 'Region list', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('RegionsTimezoneDoDelete', 'Delete timezone', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('RegionsTimezoneGetAllParentsByRegionX', 'Gets all potential parents of a timezone', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('RegionsTimezoneList', 'Timezonelist', 'eng');
