<?php
/**
* Clase CommonInclude
* 
* 
*/

class CommonInclude {

	/**
	 * Generacion de menus
	 * 
	 */
	function getMenuItemsShow($options) {
		
		if (!empty($_GET['id'])) {
			$menuItem = MenuItemQuery::create()->findPK($options['id']);
			$result = array('menuItem'=>$menuItem);
		}
		
		return $result;
	}

}