<?php
require_once "ProjectsEditBaseAction.php";

class ProjectsDoEditAction extends ProjectsEditBaseAction {

	function ProjectsDoEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);
		$smarty = $this->prepareSmarty($mapping,$smarty);
		
		if ($_POST["page"] > 0)
			$params["page"] = $_POST["page"];

		if (!empty($_POST["filters"]))
			$filters = $_POST["filters"];

		$_POST["paramsProject"]["latitude"] = Common::convertToMysqlNumericFormat($_POST["paramsProject"]["latitude"]);
		$_POST["paramsProject"]["longitude"] = Common::convertToMysqlNumericFormat($_POST["paramsProject"]["longitude"]);

		if (!is_null($_POST["paramsProject"]["exchangeRate"]))
			$_POST["paramsProject"]["exchangeRate"] = Common::convertToMysqlNumericFormat($_POST["paramsProject"]["exchangeRate"]);

		if ($_POST["action"] == "edit") { // Existing project

			$project = ProjectPeer::get($_POST["id"]);
			$project = Common::setObjectFromParams($project,$_POST["paramsProject"]);
			
			if (!$project->save())
				return $this->returnFailure($mapping,$smarty,$project);

			$logSufix = ', ' . Common::getTranslation('action: edit','common');
			Common::doLog('success', $_POST["paramsProject"]["name"] . $logSufix);

			if (isset($_POST['show'])) {
				$params = array ( "objectiveId" => $_POST["objectiveId"]);
				return $this->addParamsToForwards($params,$mapping,'success-show');
			}

			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');

		}
		else { // New project

			$project = new Project();
			$project = Common::setObjectFromParams($project,$_POST["paramsProject"]);
			if (!$project->save())
				return $this->returnFailure($mapping,$smarty,$project);

			$logSufix = ', ' . Common::getTranslation('action: create','common');
			Common::doLog('success', $_POST["paramsProject"]["name"] . $logSufix);

			if (!empty($_POST["fromObjectiveId"]) && !empty($_POST["button_add_more"])) {
				$from = array ("fromObjectiveId" => $_POST["fromObjectiveId"]);
				if (!empty($params))
					$params = array_merge($from,$params);
				else
					$params = $from;
				return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success-more');
			}

			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');
		}

	}

}
