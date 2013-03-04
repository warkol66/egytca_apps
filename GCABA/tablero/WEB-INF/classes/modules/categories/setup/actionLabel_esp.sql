DELETE FROM `security_actionLabel` WHERE `action` LIKE 'Categories%' AND `language` = 'esp';
OPTIMIZE TABLE `security_actionLabel`;
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CategoriesEdit', 'Alta/Modifica categoría', 'Alta/Modifica categoría', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CategoriesDoDelete', 'Eliminar categoría', 'Elimina categoría', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CategoriesDoEditX', 'Editar categoría', 'Edita categoría vía ajax', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('CategoriesList', 'Listar categorías', 'Listado de categorías', 'esp');
