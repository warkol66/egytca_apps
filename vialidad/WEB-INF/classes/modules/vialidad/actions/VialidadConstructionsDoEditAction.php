<?php

class VialidadConstructionsDoEditAction extends BaseAction {

	function VialidadConstructionsDoEditAction() {
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
		$section = "Constructions";
		$smarty->assign("section",$section);

		if ($_POST["page"] > 0)
			$params["page"] = $_POST["page"];

		if (!empty($_POST["filters"]))
			$filters = $_POST["filters"];

		$userParams = Common::userInfoToDoLog();
		$constructionParams = array_merge_recursive($_POST["params"],$userParams);

		$smarty->assign("filters",$filters);
		
		if (!empty($_REQUEST["returnToContract"]))
			$params["returnToContract"] = $_REQUEST["returnToContract"];

		if ($_POST["action"] == "edit" && !empty($_POST["id"])) {
			$params["id"] = $_POST["id"];
			$construction = ConstructionPeer::get($_POST["id"]);
			if (!empty($construction)) {
				$construction = Common::setObjectFromParams($construction,$_POST["params"]);

				if ($construction->isModified() && $construction->validate() && !$construction->save()) 
					return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'failure');
	
				if (!empty($_REQUEST["params"]["contractId"])) {
					$contract = ContractQuery::create()->findOneById($_REQUEST["params"]["contractId"]);
					$contract->clearConstructions();
					$contract->addConstruction($construction);
					$contract->save();
				}
				
				$smarty->assign("message","ok");
				return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success-edit');
			}
		}
		else {
			$construction = new Construction();
			$construction = Common::setObjectFromParams($construction,$constructionParams);

			if (!$construction->save())
				return $this->returnFailure($mapping,$smarty,$construction);

			if (mb_strlen($_POST["params"]["name"]) > 120)
				$cont = " ... ";

			$logSufix = "$cont, " . Common::getTranslation('action: create','common');
			Common::doLog('success', substr($_POST["params"]["name"], 0, 120) . $logSufix);

			$params['id'] = $construction->getId();
			
			if (!empty($_REQUEST["params"]["contractId"])) {
				$contract = ContractQuery::create()->findOneById($_REQUEST["params"]["contractId"]);
				$contract->addConstruction($construction);
				$contract->save();
			}
			
			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success-edit');
		}

	}

}
