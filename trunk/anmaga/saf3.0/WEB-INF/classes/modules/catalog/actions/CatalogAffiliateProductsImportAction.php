<?php

class CatalogAffiliateProductsImportAction extends BaseAction {

	function CatalogAffiliateProductsImportAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Catalog";
		$smarty->assign('module',$module);

		$moduleSection = "AffiliatesProducts";
		$smarty->assign("moduleSection",$section);

		//obtenemos todos los afiliados posibles
		$affiliatePeer = new AffiliatePeer();
		$result = $affiliatePeer->getAll();

		$smarty->assign('affiliates',$result);

		//Definimos para el template los campos del archivo a importar
		$importKey = "(Código de producto: 'obligatorio'; Precio: 'obligatorio')";
		$smarty->assign('importKey',$importKey);

		return $mapping->findForwardConfig('success');

	}

}
