<?php

class VialidadSupplyPriceDoAddDocumentAction extends BaseAction {

	function VialidadSupplyPriceDoAddDocumentAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		if ( isset($_POST["id"]) && $_POST["id"] != '' &&
			isset($_POST["supplierNumber"]) && $_POST["supplierNumber"] != '' ) {
			
			$priceBulletin = PriceBulletinPeer::retrieveByPK($_POST["id"]);
			
			$documentPeer = new DocumentPeer();
			$document = $documentPeer->create($_FILES["document_file"],$_POST['title'],$_POST["description"],$_POST['date'],$_POST["category"],$_POST["password"],$_POST["extra"]);
			if ($document === false)
				throw new Exception('error creating document');
			
			$methodName = 'setSupplierdocument'.$_POST['supplierNumber'];
			$priceBulletin->$methodName($document->getId());
			if (!$priceBulletin->save())
				throw new Exception('error saving priceBulletin');
			
		} else {
			throw new Exception('invalid supplierNumber');
		}
		
		return $mapping->generateDynamicForward('success');
	}
}