<?php

class ModulesEntitiesFieldsDoEditAction extends BaseAction {

	function ModulesEntitiesFieldsDoEditAction() {
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
		
		$smarty->assign("emptyValidation",new ModuleEntityFieldValidation());
		$smarty->assign("validationNames",ModuleEntityFieldValidationPeer::getValidationNames());

		if ($_POST["page"] > 0)
			$params["page"] = $_POST["page"];

		if (!empty($_POST["filters"]))
			$filters = $_POST["filters"];

		if (!empty($_POST["id"])) { // Existing entity

			$entity = ModuleEntityFieldPeer::get($_POST["id"]);
			$entity = common::setObjectFromParams($entity,$_POST["fieldParams"]);
      $entity->setAutomatic(null);
			$entity->save();			
			$entity->setValidationsFromParams($_POST["entityFieldValidationData"]);
			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');
		}
		else { // New entity
			$entity = new ModuleEntityField();
			$entity = common::setObjectFromParams($entity,$_POST["fieldParams"]);
						
			if (!$entity->save()) {
				$smarty->assign("entity",$entity);
				$smarty->assign("action","create");
				$smarty->assign("message","error");

				$logSufix = ', ' . Common::getTranslation('action: create','common');
				Common::doLog('failure', $_POST["fieldParams"]["name"] . $logSufix);
				return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'failure');
			}

			$entity->setValidationsFromParams($_POST["entityFieldValidationData"]);
			
			$logSufix = ', ' . Common::getTranslation('action: create','common');
			Common::doLog('success', $_POST["fieldParams"]["name"] . $logSufix);
			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');
		}

	}

}
