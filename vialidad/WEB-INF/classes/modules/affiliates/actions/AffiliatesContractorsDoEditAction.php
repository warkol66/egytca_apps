<?php

class AffiliatesContractorsDoEditAction extends BaseAction {

	function AffiliatesContractorsDoEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Affiliates";
		$smarty->assign("module",$module);

		$filters = $_POST["filters"];
		$smarty->assign("filters",$filters);

		if ($_POST["action"] == "edit" && !empty($_POST["id"])) {
			$params["id"] = $_POST["id"];
			$affiliate = ContractorQuery::create()->findPk($_POST["id"]);
			if (!empty($affiliate)) {
				$affiliate = Common::setObjectFromParams($affiliate,$_POST["params"]);

				if ($affiliate->isModified() && $affiliate->validate() && !$affiliate->save()) 
					return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'failure');
	
				$smarty->assign("message","ok");
				return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');
			}
		}
		else {
			$affiliate = new Contractor();
			$affiliate = Common::setObjectFromParams($affiliate,$_POST["params"]);

			if (!$affiliate->validate()) {
				$smarty->assign("affiliate",$affiliate);
				$smarty->assign("message","error");
				return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'failure');
			}
			else {
				$_SESSION['newAffiliate'] = $affiliate;
				$params['ownerCreation'] = 1;
				return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success-create');
			}
		}
	}

}
