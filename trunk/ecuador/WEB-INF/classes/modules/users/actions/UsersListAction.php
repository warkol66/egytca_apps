<?php
/**
 * Listado de usuarios
 *
 * @package users
 */
class UsersListAction extends BaseListAction {
	
 /**
	* Constructor
	*/
	function __construct() {
		parent::__construct('User');
	}

 /**
	* Acciones a ejecutar antes de obtener la coleccion de objetos
	*/
	protected function preList() {
		parent::preList();
		//Aplico filtro para eleminar el usuario Systems id = -1
		$this->filters['ignoreNonRealUsers'] = true;

	}

 /**
	* Acciones a ejecutar despues de obtener la coleccion de objetos
	*/
	protected function postList() {
		// Elimino el filtro para que no aparezca en el paginador
		unset($this->filters['ignoreNonRealUsers']);
		parent::postList();
		
		// Listado de usuarios inactivos
		$this->smarty->assign("inactiveUsers",User::getInactives());

	}

}
