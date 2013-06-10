<?php



/**
 * Skeleton subclass for performing query and update operations on the 'common_menuItemInfo' table.
 *
 * Items de los menues dinámicos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.common.classes
 */
class MenuItemInfoPeer extends BaseMenuItemInfoPeer {
	
/**
	* Crea un menú info.
	*
	* @param array $menuParams parametros del menú info.
	* @return $menuItem, false sino
	*/
	function create($menuParams) {
		$menuObj = new MenuItemInfo();
		foreach ($menuParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($menuObj,$setMethod) ) {          
				if (!empty($value) || $value == "0")
					$menuObj->$setMethod($value);
				else
					$menuObj->$setMethod(null);
			}
		}

		try {
			$menuObj->save();
			return $menuObj;
		} catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions")) 
				print_r($exp->getMessage());
			return false;
		}
	}
	
	/**
	* Actualiza la informacion de un menú info.
	*
	* @param int $id id del menú info
	* @param array $menuParams parametros del menú info.
	* @return $menuItem, false sino
	*/
	function update($id,$menuParams) {
		$menuObj = MenuItemInfoQuery::create()->findPk($id);
		foreach ($menuParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($menuObj,$setMethod) ) {          
				if (!empty($value) || $value == "0")
					$menuObj->$setMethod($value);
				else
					$menuObj->$setMethod(null);
			}
		}

		try {
			$menuObj->save();
			return $menuObj;
		} catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions")) 
				print_r($exp->getMessage());
			return false;
		}
	}
 	/**
	* Obtiene un menuItemInfo a partir de su id.
	*
	* @param int $id id del menuItemInfo
	* @return MenuItemInfo Informacion del menuItemInfo
	*/
	public static function get($id) {
		return MenuItemInfoQuery::create()->findPK($id);
	}
} // MenuItemInfoPeer
