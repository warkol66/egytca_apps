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
	
	protected function preDelete(){
		parent::preDelete();
		
		//elimina zonas y archivo
		Banner::removeFromAllZones($_POST['id']);
		$banner = BannerQuery::create()->findOneById($_POST['id']);
		unlink('WEB-INF/classes/modules/banners/files/' . $_POST['id'] . '.' . $banner->getExtension());
	}
	
	protected function postDelete(){
		parent::postDelete();
		
		$this->smarty->assign("module","Banners");
		
	}

}
