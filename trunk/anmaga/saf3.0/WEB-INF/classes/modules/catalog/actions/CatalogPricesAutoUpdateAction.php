<?php

class CatalogPricesAutoUpdateAction extends BaseAction {

	/**
	 * Constructor
	 *
	 */
	function CatalogPricesAutoUpdateAction() {

	}

	function processGeneralUpdate($filePath) {
		ProductPeer::doImportPrices($filePath);
	}

	function processAffiliateUpdate($affiliateName,$filePath) {

		//procesamiento de datos de afiliado
		$affiliate = AffiliatePeer::getByName($affiliateName);

		if (!empty($affiliate))
			$affiliate->doImportPrices($filePath);

	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Catalog";
		$smarty->assign('module',$module);

		global $system;
		$updatesDir =  'WEB-INF/../' . $system["config"]["catalog"]["pricesAutoUpdate"]["updatesDir"]."/";
		$processedDir = $updatesDir."processed/";
		$updatesDirDesc = opendir($updatesDir);

		while (($file = readdir($updatesDirDesc)) !== false) {
			$filePath = $updatesDir . $file;
			if (is_file($filePath)) {

				$parts = explode('.',$file);
				if (count($parts) == 2 && $parts[1] == 'txt') {
					$filename = $parts[0];			
					if ($filename == 'General') {
						//procesamiento general
						$this->processGeneralUpdate($filePath);
						copy($filePath,$processedDir . $filename . "_" . date("Ymdhms") . '.txt');
						unlink($filePath);
						Common::doLog('success','archivo: ' . $filename);
					}
					else {
						//No vienen dos partes, solo el afiliado
						//$nameParts = explode('_',$filename);
						//if (count($nameParts) == 2) {
						$affiliate = AffiliatePeer::getByName($filename);
						if (!empty($affiliate)) {
							$affiliateName = $affiliate->getName();
							$this->processAffiliateUpdate($affiliateName,$filePath);
							copy($filePath,$processedDir . $filename . "_" . date("Ymdhms") . '.txt');
							unlink($filePath);
							Common::doLog('success','archivo: ' . $filename);				
						}
					}
				}
			}
		}
		closedir($updatesDirDesc);
		die();
	}
}
