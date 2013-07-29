<?php
/**
 * BannersClientsDoEditAction
 *
 * Guarda los cambios a un cliente existente cliente del módulo de Banners, o crea uno nuevo
 * @package banners
 */

/**
 * Requires de Clases base del modelo y del módulo banners
 */
//require_once("BaseAction.php");
//require_once("BannerClientPeer.php");

/**
 * Class BannersClientsDoEditAction
 *
 * Guarda los cambios a un cliente existente cliente del módulo de Banners, o crea uno nuevo
 * @package banners
 */
class BannersClientsDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('BannerClient');
	}
	
	protected function postUpdate(){
		parent::postUpdate();
		
		$this->smarty->assign("module","Banners");
		$this->smarty->assign("section","Clients");
		
	}

}
