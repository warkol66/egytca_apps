<?php
/** 
 * BannersClientsListAction
 *
 * Muestra el listado de clientes de Banners
 * @package banners 
 */

/**
 * Requires de Clases base del modelo y del módulo banners
 *
require_once("BaseAction.php");
require_once("BannerClientPeer.php");

/** 
 * Class BannersClientsListAction
 *
 * Muestra el listado de clientes de Banners
 * @package banners 
 */
class BannersClientsListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('BannerClient');
	}
	
	protected function postList(){
		parent::postList();
		
		$this->smarty->assign("module","Banners");
		$this->smarty->assign("section","Clients");
		
		//$this->smarty->assign("message", $_GET['message']);
		
	}

}
