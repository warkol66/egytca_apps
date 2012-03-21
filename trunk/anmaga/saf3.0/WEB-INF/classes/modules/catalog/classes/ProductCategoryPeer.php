<?php

/**
 * Class ProductCategoryPeer
 *
 * @package ProductCategory
 */
class ProductCategoryPeer extends BaseProductCategoryPeer {

  /**
  * Crea una categoria de producto.
  *
  * @param mixed $params array asociativo de parametros
  * @return la categoria si se creo la categoria correctamente, false sino
	*/
	function create($params) {
    $productCategoryObj = CategoryPeer::create($params);
    
    $image = $params['image'];
    if (!empty($image) && !empty($productCategoryObj)) {
		  $uploadfile = 'WEB-INF/productCategories/' . $productCategoryObj->getId();
		  move_uploaded_file($image['tmp_name'], $uploadfile);
    }
    return $productCategoryObj;
	}

  /**
  * Actualiza la informacion de una categoria de producto.
  *
  * @param int $id id de la categoria
  * @param mixed $params array asociativo de parametros
  * @return la categoria si se actualizo la informacion correctamente, false sino
	*/
  function update($id,$params) {
    $productCategoryObj = CategoryPeer::update($id,$params);

    $image = $params['image'];
		if (!empty($image) && !empty($productCategoryObj)) {
			$uploadfile = 'WEB-INF/productCategories/' . $productCategoryObj->getId();
  		move_uploaded_file($image['tmp_name'], $uploadfile);
  	}
		return $productCategoryObj;
  }

	/**
	* Elimina una categoria de producto a partir de los valores de la clave.
	*
  * @param int $id id de la categoria de producto
	*	@return boolean true si se elimino correctamente la categoria, false sino
	*/
  function delete($id) {
  	return CategoryPeer::delete($id);
  }

  /**
  * Obtiene la informacion de un product category.
  *
  * @param int $id id del productcategory
  * @return array Informacion del productcategory
  */
  function get($id) {
		return CategoryQuery::create()->filterByModule('catalog')->filterById($id)->findOne();
  }
  
  /**
  * Obtiene si existe una categoria de producto.
  *
  * @param int $id id de la categoria
  * @return boolean true si existe la categoria con ese id, false sino
  */
  function exists($id) {
    return CategoryQuery::create()->filterByModule('catalog')->filterById($id)->count() > 0;
  }

  /**
  * Obtiene todas las categories de productos.
	*
	*	@return array Informacion sobre todos los productcategories
  */
	function getAll() {
		return CategoryQuery::create()->filterByModule('catalog')->find();
  }
  
  /**
  * Obtiene una categoria en base a su nombre.
	*
	* @param string $name Nombre de la categoria
	*	@return Node Nodo de la categoria con el nombre pasado como parametro
  */
	function getByName($name) {
		return CategoryQuery::create()->filterByModule('catalog')->filterByName($name)->findOne();
  }
  


}
