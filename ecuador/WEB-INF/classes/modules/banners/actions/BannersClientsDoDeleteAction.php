<?php
/**
 * BannersClientsDoDeleteAction
 *
 * Elimina un cliente del m�dulo de Banners
 * @package banners
 */

/**
 * Requires de Clases base del modelo y del m�dulo banners
 */
//require_once("BaseAction.php");
//require_once("BannerClientPeer.php");

/**
 * Class BannersClientsDoDeleteAction
 *
 * Elimina un cliente del m�dulo de Banners
 * @package banners
 */
class BannersClientsDoDeleteAction  extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('BannerClient');
	}
	
	protected function postDelete(){
		parent::postDelete();
		
		$this->smarty->assign("module","Banners");
		$this->smarty->assign("section","Clients");
		
	}

}
