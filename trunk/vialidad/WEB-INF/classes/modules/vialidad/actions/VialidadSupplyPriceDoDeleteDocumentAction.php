<?php

class VialidadSupplyPriceDoDeleteDocumentAction extends BaseAction {

	function VialidadSupplyPriceDoDeleteDocumentAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		if (isset($_POST["id"]) && $_POST["id"] != '' &&
			isset($_POST["supplierNumber"]) && $_POST["supplierNumber"] != '') {

			$priceBulletin = PriceBulletinPeer::retrieveByPK($_POST["id"]);

			$methodName = 'getSupplierdocument'.$_POST['supplierNumber'];
			$documentPeer = new DocumentPeer();

			if (!$documentPeer->delete($priceBulletin->$methodName()))
				throw new Exception('error deleting document');
		}
		else
			throw new Exception('invalid supplierNumber');

		return $this->generateDynamicForward('success');
	}
}