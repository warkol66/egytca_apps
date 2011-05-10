DELETE FROM `security_actionLabel` WHERE `action` LIKE 'Regions%' AND `language` = 'esp';
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('RegionsEdit', 'Alta/Modificación de regiones', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('RegionsTimezoneEdit', 'Alta/Modificación de zonas horarias', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('RegionsDoDelete', 'Eliminar regiones', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('RegionsGetAllParentsByRegionX', 'Obtiene todos los potenciales padres de una región', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('RegionsList', 'Listado de regiones del sistema', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('RegionsTimezoneDoDelete', 'Elimina una zona horaria', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('RegionsTimezoneGetAllParentsByRegionX', 'Obtiene todos los potenciales padres de una zona horaria', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('RegionsTimezoneList', 'Listado de zonas horariasdel sistema', 'esp');
