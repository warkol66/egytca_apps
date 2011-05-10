DELETE FROM `security_actionLabel` WHERE `action` LIKE 'Categories%' AND `language` = 'esp';
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('CategoriesEdit', 'Editar categoría', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('CategoriesList', 'Listado de categorías', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('CategoriesDoDelete', 'Eliminar categoría', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('CategoriesDoEditX', 'Editar categoría', 'esp');
