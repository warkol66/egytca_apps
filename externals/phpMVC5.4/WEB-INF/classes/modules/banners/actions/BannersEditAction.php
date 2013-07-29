<?php
/**
 * BannersEditAction
 *
 * Muestra el formulario de edición de banners, si existe, muestra sus datos.
 * @package banners
 */
class BannersEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('Banner');
	}
	
	protected function postEdit(){
		parent::postEdit();
		
		$this->smarty->assign("module","Banners");
		
		// todos los clientes, para el select
		$this->smarty->assign("clients", BannerClientQuery::create()->find());
		$this->smarty->assign("allZones", BannerZoneQuery::create()->find());
		
		if (isset($_GET['id'])) {
			$this->smarty->assign("selectedZones", $this->entity->getBannerZoneRelationsJoinBannerZone());
		}
		
		/*
		$conditions = array(true => "Activo", "Inactivo");
		$smarty->assign("conditions", $conditions);

		$frecuencies = BannerPeer::getFrecuencies();
		$smarty->assign("frecuencies", $frecuencies);
		*/
		
	}

}
