<?php



/**
 * Skeleton subclass for representing a row from the 'common_menuItem' table.
 *
 * Items de los menues dinámicos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.common.classes
 */
class MenuItem extends BaseMenuItem {
	
	/*
	 * Obtiene la información del item según el idioma.
	 * 
	 * @param string $language codigo de idioma (esp, eng, etc.). Por defecto se utiliza el idioma actual del sistema.
	 * @return $MenuItemInfo informacion correspondiente al item en base al idioma si existe.
	 */
	public function getMenuInfo($language = NULL) {
		if (is_null($language) || empty($language)) $language = Common::getCurrentLanguageCode();
		return MenuItemInfoQuery::create()->filterByMenuItemId($this->getId())
										  ->filterByLanguage($language)
										  ->findOneOrCreate();
	}
	
/*
	 * Obtiene la información del item según el idioma a partir de la informacion del security.
	 * 
	 * @param SecurityAction $action, acción sobre la que se quiere tener información.
	 * @param string $language codigo de idioma (esp, eng, etc.). Por defecto se utiliza el idioma actual del sistema.
	 * @return $MenuItemInfo informacion correspondiente al item en base al idioma.
	 */
	public function getMenuInfoFromSecurityActionLabel($action, $language = NULL) {
		if (is_null($language) || empty($language)) $language = Common::getCurrentLanguageCode();
		$actionLabelInfo = $action->getActionInfo($language);
		$menuInfo = MenuItemInfoQuery::create()->filterByMenuItemId($this->getId())
										  	   ->filterByLanguage($language)
										  	   ->findOneOrCreate();
		if (!empty($actionLabelInfo)) {
			$menuInfo->setName($actionLabelInfo->getLabel());
			$menuInfo->setTitle($actionLabelInfo->getLabel());
			$menuInfo->setDescription($actionLabelInfo->getDescription());
		}
		
		return $menuInfo;
	}
	
	/**
	 * Code to be run before deleting the object in database
	 * @param PropelPDO $con
	 * @return boolean
	 */
	public function preDelete(PropelPDO $con = null) {
		
		// eliminamos todos los menús que tengan a la instancia como padre.

		$menuItems = MenuItemQuery::create()->filterByParentId($this->getId())->find();
		foreach($menuItems as $menuItem) {
			$menuItem->delete();
		}
		return true;

	}
	
	public function getAllChilds() {
		return MenuItemQuery::create()->filterByParentId($this->getId())->orderByOrder()->find();
	}
	
	public function save(PropelPDO $con = null) {
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
	
	/**
	 * Devuelve un array asociativo con los parametros asociados a la accion del menuItem.
	 * @return array $params array asociativo con los parametros asociados a la accion del menuItem.
	 */
	public function getParams() {
		$explodedUrl = explode('?', $this->getUrl());
		$explodedUrl = Common::explode_assoc('=', '&', $explodedUrl[1]);		
		//el parametro 'do' no lo queremos porque corresponde al action
		unset($explodedUrl['do']);
		return $explodedUrl;
	}
	
	public function usingExternalUrl() {
		$url = $this->getUrl();
		if ( (empty($url)) || (strncmp("Main.php", $url, 8) == 0)) {
			return false;
		} else {
			return true;
		}
	}
	
	/**
	 * Set the value of [parentid] column.
	 * Id item padre
	 * @param      int $v new value
	 * @return     MenuItem The current object (for fluent API support)
	 */
	public function setParentid($v)
	{
		if ($v === '') $v = NULL;
		return parent::setParentId($v);
	} // setParentid()

} // MenuItem
