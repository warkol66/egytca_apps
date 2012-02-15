<?php

class AffiliatesClientsDoEditAction extends BaseAction {

	function AffiliatesClientsDoEditAction() {
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

		$id = $request->getParameter("id");

		if (!empty($id)) {
			$affiliate = ClientQuery::create()->findPk($id);
			if (!empty($affiliate)) {
				$affiliate = Common::setObjectFromParams($affiliate,$_POST["params"]);

				if ($affiliate->isModified() && $affiliate->validate() && !$affiliate->save()) 
					return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'failure');
	
				$smarty->assign("message","ok");
				return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');
			}
		}
		else {
			$affiliate = new Client();
			$affiliate = Common::setObjectFromParams($affiliate,$_POST["params"]);

			if (!$affiliate->validate()) {
				$smarty->assign("affiliate",$affiliate);
				$smarty->assign("message","error");
				return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'failure');
			}
			else {
				$_SESSION['newAffiliate'] = $affiliate;
				$params['ownerCreation'] = 1;
				$params['class'] = 'Client';
				return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success-create');
			}
		}
	}

}
