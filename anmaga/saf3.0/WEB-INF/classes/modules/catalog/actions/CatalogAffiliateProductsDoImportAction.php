<?php

class CatalogAffiliateProductsDoImportAction extends BaseAction {

	function CatalogAffiliateProductsDoImportAction() {
		;
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

		$moduleSection = "AffiliatesProducts";
		$smarty->assign("moduleSection",$section);

		if (isset($_POST['affiliate']) && isset($_FILES["fileImport"]["tmp_name"])) {

			$affiliate = AffiliatePeer::get($_POST["affiliate"]);

			$result = $affiliate->doImportPrices($_FILES["fileImport"]["tmp_name"]);

			$smarty->assign("rowsCreated",$result["rowsCreated"]);
			$smarty->assign("rowsReaded",$result["rowsReaded"]);
			$smarty->assign("errorCodes",$result["errorCodes"]);

			return $mapping->findForwardConfig('success');
		}

		return $mapping->findForwardConfig('failure');

	}

}
