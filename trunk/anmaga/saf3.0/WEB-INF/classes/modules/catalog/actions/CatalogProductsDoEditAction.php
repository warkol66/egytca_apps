<?php

class CatalogProductsDoEditAction extends BaseAction {

	function CatalogProductsDoEditAction() {
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
    $smarty->assign("module",$module);

		$moduleSection = "Products";
    $smarty->assign("moduleSection",$section);
    
		if ($_POST["page"] > 0)
			$params["page"] = $_POST["page"];

		if (!empty($_POST["filters"]))
			$filters = $_POST["filters"];

    $productParams = $_POST["product"];
    $productParams['price'] = Common::convertToMysqlNumericFormat($productParams['price']);
    $productParams['image'] = $_FILES['image'];

		if ( $_POST["action"] == "edit" ) {
			//estoy editando un producto existente
			ProductPeer::update($_POST["id"], $productParams);
			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');
		}
		else {
		  //estoy creando un nuevo producto

      if (!ProductPeer::create($productParams))
				return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'failure');

			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');
		}

	}

}
