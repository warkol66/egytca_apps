<?php

class CatalogProductCategoriesGetImageAction extends BaseAction {

	function CatalogProductCategoriesGetImageAction() {
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
    $smarty->assign("module",$module);

		$moduleSection = "ProductCategories";
    $smarty->assign("moduleSection",$section);

		global $moduleRootDir;

    if (!empty($_GET["id"])) {
			readfile($moduleRootDir."/WEB-INF/productCategories/".$_GET["id"]);
    }

	}

}
