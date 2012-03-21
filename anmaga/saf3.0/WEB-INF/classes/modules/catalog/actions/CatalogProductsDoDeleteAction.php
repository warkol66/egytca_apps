<?php

class CatalogProductsDoDeleteAction extends BaseAction {

	function CatalogProductsDoDeleteAction() {
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

		$product = ProductQuery::create()->findOneById($_POST["id"]);
		if (!empty($product)) {
			$productName = $product->getName();
			try {
				$product->delete();
			}
			catch (PropelException $exp) {
				if (ConfigModule::get("global","showPropelExceptions"))
					print_r($exp->getMessage());
				return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'failure');
			}
		}
		else
			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'failure');

		$logSufix = ', ' . Common::getTranslation('action: delete','common');
		Common::doLog('success', $productName . $logSufix);

		return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');

	}

}
