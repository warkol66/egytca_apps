<?php
/**
 * BannersDoDeleteAction
 *
 * Elimina un banner
 * @package banners
 */

/**
 * Requires de Clases base del modelo y del módulo banners
 *
require_once("BaseAction.php");
require_once("BannerPeer.php");

/**
 * Class BannersDoDeleteAction
 *
 * Elimina un banner
 * @package banners
 */
class BannersDoDeleteAction  extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('Banner');
	}
	
	protected function postDelete(){
		parent::postDelete();
		
		$smarty->assign("module","Banners");
		
	}

}
