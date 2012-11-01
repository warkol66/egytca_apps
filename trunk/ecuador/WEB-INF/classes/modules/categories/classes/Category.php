<?php

/** 
 *
 * @package category 
 */
class Category extends BaseCategory {
	
	public function __toString() {
		return $this->getName();
	}

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
  
  public function setParentId($parentId) {
    $parentNode = $this->getParent();
    $newParentNode = CategoryQuery::create()->findPk($parentId);
    
    if ((!empty($parentNode)) && ($parentNode->getId() != $parentId)) {
      if (!empty ($newParentNode)) {
        $newScope = $newParentNode->getScope();
        $this->moveSubtreeInBetweenTrees($newParentNode->getRightValue(), $newParentNode->getLevel() - $this->getLevel() + 1, $newScope);
      }
    } else if (empty($newParentNode)) {
      $lastScope = CategoryQuery::create()->treeRoots()->orderByScope(Criteria::DESC)->findOne();
      if (!empty($lastScope))
        $scope = $lastScope->getScope() + 1;
      else
        $scope = 0;
      $this->setScope($scope);
      $this->makeRoot();
    } else {
      $this->insertAsLastChildOf($newParentNode);
    }
    
    if ((!empty($newParentNode)) && $newParentNode->getModule() != $this->getModule()) {
      $this->setModule($newParentNode->getModule());
    }
  }

  public function moveSubtreeInBetweenTrees($destLeft, $levelDelta, $newScope, PropelPDO $con = null) {
    $left  = $this->getLeftValue();
    $right = $this->getRightValue();
    
    $prevScope = $this->getScopeValue();
  
    $treeSize = $right - $left +1;
    
    if ($con === null) {
      $con = Propel::getConnection(CategoryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
    }
      
    $con->beginTransaction();
    try {
      // make room next to the target for the subtree
      CategoryPeer::shiftRLValues($treeSize, $destLeft, null, $newScope, $con);
    
      if ($left >= $destLeft && $prevScope == $newScope) { // src was shifted too?
        $left += $treeSize;
        $right += $treeSize;
      }
      
      $this->setScopeDeeply($newScope);
      
      if ($levelDelta) {
        // update the levels of the subtree
        CategoryPeer::shiftLevel($levelDelta, $left, $right, $newScope, $con);
      }
      
      // move the subtree to the target
      CategoryPeer::shiftRLValues($destLeft - $left, $left, $right, $newScope, $con);
    
      // remove the empty room at the previous location of the subtree
      CategoryPeer::shiftRLValues(-$treeSize, $right + 1, null, $prevScope, $con);
      
      // update all loaded nodes
      CategoryPeer::updateLoadedNodes($con);
      
      $con->commit();
    } catch (PropelException $e) {
      $con->rollback();
      throw $e;
    }
  }

  public function setScopeDeeply($scope) {
    CategoryQuery::create()->descendantsOf($this)->update(array('Scope' => $scope));
    $this->setScopeValue($scope);
  }
  
  public function save(PropelPDO $con = null)
  {
    try {
      if ($this->validate()) { 
        parent::save($con);
        return true;
      } else {
        return false;
      }
    }
    catch (PropelException $exp) {
      if (ConfigModule::get("global","showPropelExceptions"))
        print_r($exp->getMessage());
      return false;
    }
  }
  
  public function postInsert(PropelPDO $con = null) {
    //regla de negocio, agregar siempre a grupo usuarios
    $groupPeer = new GroupPeer();
    $group = $groupPeer->get(3);
      
    if (empty($group)) {
      //TODO: creamos el grupo usuarios
    }
    
    if (!empty($group))
      $groupPeer->addCategoryToGroup($this->getId(),$group->getId());
  }
}
