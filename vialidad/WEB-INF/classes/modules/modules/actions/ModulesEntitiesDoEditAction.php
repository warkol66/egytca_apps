<?php

class ModulesEntitiesDoEditAction extends BaseAction {

	function ModulesEntitiesDoEditAction() {
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

		$module = "Modules";
    $entityParams = $_POST["entityParams"];
    $entityParams['behaviors'] = serialize($entityParams['behaviors']);

		if ($_POST["page"] > 0)
			$params["page"] = $_POST["page"];

		if (!empty($_POST["filters"]))
			$filters = $_POST["filters"];

		if (!is_null($_POST["id"])) { // Existing entity

			ModuleEntityPeer::update($_POST["id"],$entityParams);
			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');

		}
		else { // New entity

			if ( !ModuleEntityPeer::create($entityParams) ) {
				$entity = new ModuleEntity();

				$entity = common::setObjectFromParams($entity,$entityParams);

				$smarty->assign("entity",$entity);
				$smarty->assign("action","create");
				$smarty->assign("message","error");

				$logSufix = ', ' . Common::getTranslation('action: create','common');
				Common::doLog('failure', $entityParams["name"] . $logSufix);
				return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'failure');
			}

			$logSufix = ', ' . Common::getTranslation('action: create','common');
			Common::doLog('success', $entityParams["name"] . $logSufix);
			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');
		}

	}

}
