<?php

class ProjectsDoDeleteAction extends BaseAction {

	function ProjectsDoDeleteAction() {
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

		$module = "Projects";

		$project = ProjectPeer::get($_POST["id"]);

		if ($_POST["page"] > 0)
			$params["page"] = $_POST["page"];

		if (!empty($_POST["filters"]))
			$filters = $_POST["filters"];

		if (Common::isAffiliatedUser() && !$project->isOwner(Common::getAffiliatedId()))
			//es usuario afiliado pero no es duenio de la instancia
			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'failure');

		$projectName = $project->getName();
		//es admin o es dueño
		$project->delete();

		$logSufix = ', ' . Common::getTranslation('action: delete','common');
		Common::doLog('success', $projectName . $logSufix);

		if (isset($_POST['show']))
			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success-show');

		return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');

	}

}
