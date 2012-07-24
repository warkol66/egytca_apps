<?php



/**
 * Skeleton subclass for performing query and update operations on the 'common_menuItem' table.
 *
 * Items de los menues dinámicos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.common.classes
 */
class MenuItemPeer extends BaseMenuItemPeer {
	
	/**
	* Crea un menú.
	*
	* @param array $menuParams parametros del menú.
	* @return $menuItem, false sino
	*/
	function create($menuParams) {
		$menuObj = new MenuItem();
		foreach ($menuParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($menuObj,$setMethod) && (strcasecmp($setMethod,"setId") != 0) ) {          
				if (!is_null($value) && $value != '')
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
	* Actualiza la informacion de un menú.
	*
	* @param int $id id del menú
	* @param array $menuParams parametros del menú.
	* @return $menuItem, false sino
	*/
	function update($id,$menuParams) {
		$menuObj = MenuItemQuery::create()->findPk($id);
		foreach ($menuParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($menuObj,$setMethod) && (strcasecmp($setMethod,"setId") != 0)) {          
				if (!is_null($value) && $value != '')
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
	* Elimina un menú y todos sus submenús y sus correspondientes informaciones de lenguage.
	*
	* @param int $menuItemId id del menú
	* @return boolean
	*/
	function delete($menuItemId) {
		try {
			MenuItemQuery::create()->findPK($menuItemId)->delete();
			return true;
		} catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}
	
 	/**
	* Obtiene un menuItem a partir de su id.
	*
	* @param int $id id del menuItem
	* @return MenuItem Informacion del menuItem
	*/
	public static function get($id) {
		return MenuItemQuery::create()->findPK($id);
	}
	
	/**
	 * Genera la url a partir del nombre del action y sus parametros
	 * @param string $action nombre del action
	 * @param array $params arreglo asociativo con los parametros del action
	 * @return string $url url resultante
	 */
	public static function generateUrl($action, $params) {
		$url = 'Main.php?do=' . $action;
		foreach($params as $key => $value) {
			$url .= '&' . $key . '=' . $value;
		}
		return $url;
	}
	

} // MenuItemPeer
