<?php

class VialidadSuppliersDoEditAction extends BaseAction {

	function VialidadSuppliersDoEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Vialidad";
		$smarty->assign("module",$module);
		$section = "Suppliers";
		$smarty->assign("section",$section);

		if ($_POST["page"] > 0)
			$params["page"] = $_POST["page"];

		if (!empty($_POST["filters"]))
			$filters = $_POST["filters"];

		$userParams = Common::userInfoToDoLog();
		$supplierParams = array_merge_recursive($_POST["params"],$userParams);

		$smarty->assign("filters",$filters);

		if ($_POST["action"] == "edit" && !empty($_POST["id"])) {
			$params["id"] = $_POST["id"];
			$supplier = SupplierPeer::get($_POST["id"]);
			if (!empty($supplier)) {
				$supplier = Common::setObjectFromParams($supplier,$_POST["params"]);

				if ($supplier->isModified() && $supplier->validate() && !$supplier->save()) 
					return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'failure');
	
				$smarty->assign("message","ok");
				return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success-edit');
			}
		}
		else {
			$supplier = new Supplier();
			$supplier = Common::setObjectFromParams($supplier,$supplierParams);

			if (!$supplier->save())
				return $this->returnFailure($mapping,$smarty,$supplier);

			if (mb_strlen($_POST["params"]["name"]) > 120)
				$cont = " ... ";

			$logSufix = "$cont, " . Common::getTranslation('action: create','common');
			Common::doLog('success', substr($_POST["params"]["name"], 0, 120) . $logSufix);

			$params['id'] = $supplier->getId();
			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success-edit');
		}

	}

}
