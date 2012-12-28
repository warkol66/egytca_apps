<?php
/**
 * BannersDoEditAction
 *
 * Guarda los cambios de los banners actuales o los datos de uno nuevo
 * @package banners
 */
class BannersDoEditAction extends BaseDoEditAction {

	function __construct() {
		parent::__construct('Banner');
	}

	protected function preUpdate() {
		parent::preUpdate();

		if (!$_FILES["document_file"]['name'] == '') {
			$path = pathinfo($_FILES["document_file"]['name']);
			$this->entityParams['extension'] = strtolower($path['extension']);
		}
	}

	protected function postUpdate(){
		parent::postUpdate();

		$this->smarty->assign("module","Banners");
		$this->entity->removeFromAllZones();
		$zones = $_POST['params']['zones'];

		foreach($zones as $zoneId)
			$this->entity->addToZone($zoneId, $this->entity->getId());

		global $appDir;
		$bannersPath = realpath($appDir . '/WEB-INF/classes/modules/banners/files/');

		if (!empty($_FILES["document_file"]['tmp_name'])
					&& !move_uploaded_file($_FILES["document_file"]['tmp_name'], $bannersPath . "/" . $this->entity->getId()))
			$this->params["uploadeFailure"] = true;

	}

}
