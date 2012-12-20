<?php
/**
 * BannersClientsEditAction
 *
 * Muestra el formulario de edición de clientes de banners
 * @package banners
 */

/**
 * Requires de Clases base del modelo y del módulo banners
 *
require_once("BaseAction.php");
require_once("BannerClientPeer.php");
require_once("BannerClient.php");

/**
 * Class BannersClientsEditAction
 *
 * Muestra el formulario de edición de clientes de banners
 * @package banners
 */
class BannersClientsEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('BannerClient');
	}
	
	protected function postEdit(){
		parent::postEdit();
		
		$this->smarty->assign("module","Banners");
		$this->smarty->assign("section","Clients");
		
	}

}
