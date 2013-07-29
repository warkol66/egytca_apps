<?php

/**
 *
 * @package    users
 * @subpackage groups
 */
class Group extends BaseGroup {

	/**
	* Obtiene las categorias que puede acceder un grupos de usuarios.
	*
	* @return array GroupCategories
	*/
	function getCategories() {
		return $this->getCategorys();
	}

	/**
	* Obtiene las categorias que no puede acceder un grupos de usuarios.
	*
	* @return array Categories
	*/
	function getCandidateCategories() {

		$categoriesIds = GroupCategoryQuery::create()->select('Categoryid')->filterByGroup($this)->find();
		$categories = CategoryQuery::create()->add(CategoryPeer::ID, $categoriesIds, Criteria::NOT_IN)->find();

		return $categories;

	}
	
	/**
	* Devuelve el string para ser usado en el historico de operaciones
	*	@return string con el texto a guardar en el historico de operaciones
	*/
	public function getLogData(){
		return substr($this->getName(),0,50);
	}

}
