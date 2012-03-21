<?php

class CatalogProductsGetImageAction extends BaseAction {

	function CatalogProductsGetImageAction() {
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

		$section = "Products";
    $smarty->assign("section",$section);

		global $moduleRootDir;

    if (!empty($_GET["code"])) {
			$file = $moduleRootDir."/WEB-INF/products/".$_GET["code"];
			if (!empty($_GET["tn"])) 
				$file .= "_t0";
			$file = $file.".jpg";
			if (file_exists($file))
				readfile($file);
			else
				readfile($moduleRootDir."/images/noPhotoAvailable.png");			
    }

	}

}
