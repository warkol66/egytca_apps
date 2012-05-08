<?php

/** 
 *
 * @package category 
 */
class Category extends BaseCategory {

	function hasAccessUser($user) {
			foreach ($user->getGroups() as $groupUser) {
				if ( $this->hasAccessGroup($groupUser->getGroup()) )
					return true;
			}
			return false;
	}

	function hasAccessGroup($group) {
  	$groupCategory = GroupCategoryPeer::retrieveByPK($group->getId(),$this->getId());
  	if ( !empty($groupCategory) )
  		return true;
  	return false;
	}
	
	/**
	 * indica si es una categoria padre
	 * Se consideran como padres en realidad a aquellas que no son hijas de nadie.
	 * @return boolean
	 */
	public function isParent() {
		return !$this->isChildren();
	}
	
	/**
	 * indica si es una categoria hija
	 * @return boolean
	 */
	public function isChildren() {
		
		return ($this->hasParent());
	}
	
	/**
	 * Obtiene el modulo de la categoria
	 * Se sobrecargo dado que de esta forma siempre nos aseguramos que si es una
	 * categoria hija, traiga el modulo del padre.
	 */
	public function getModule() {
		if ($this->isChildren()) {
			$parent = $this->getParent();
			return $parent->getModule();
		}
		
		return parent::getModule();	
	}
	
	/**
	 * Obtiene todas las categorias hijas
	 * @return array de instancias de Category
	 */
	public function getChildrenCategories() {
		
		$categories = CategoryPeer::getByParentId($this->getId());
		return $categories;
		
	}

	/**
	 * Obtiene todas las categorias hijas con acceso al usuario
	 * @return array de instancias de Category
	 */
	public function getChildrenCategoriesByUser($user) {
		
		$categories = CategoryPeer::getByParentIdAndUser($this->getId(),$user);
		return $categories;
		
	}
	
	/**
	 * Devuelve la cantidad de documentos que hay en la categoria
	 * @return integer
	 */
	public function getDocumentsCount() {
		return DocumentPeer::getDocumentsByCategoryCount($this);
	}
	
	public function getParentId() {
		return $this->hasParent() ? $this->getParent()->getId() : null;
	}

}
