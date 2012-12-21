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
	
	protected function postUpdate(){
		parent::postUpdate();
		
		$this->smarty->assign("module","Banners");
		
		global $appDir;
		$bannersPath = realpath($appDir . '/WEB-INF/classes/modules/banners/files/');
		if (!move_uploaded_file($_FILES["document_file"]['tmp_name'], $bannersPath . $this->entity->getId()))
			$this->smarty->assign("message", "uploadFailure");
		
		/* Setear bien los parametros
		$campaignStartDate = $_POST['campaignStartDate']['Year'] . '-' . $_POST['campaignStartDate']['Month'] . '-' . $_POST['campaignStartDate']['Day'];
		$campaignFinalDate = $_POST['campaignFinalDate']['Year'] . '-' . $_POST['campaignFinalDate']['Month'] . '-' . $_POST['campaignFinalDate']['Day'];
		*/
		
	}

}
