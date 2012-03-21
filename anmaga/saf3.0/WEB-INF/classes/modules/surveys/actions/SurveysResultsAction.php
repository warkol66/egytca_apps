<?php

class SurveysResultsAction extends BaseAction {

	function SurveysResultsAction() {
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

		$module = "Surveys";
		$smarty->assign("module",$module);
		$section = "Surveys";
		$smarty->assign("section",$section);

		$survey = SurveyPeer::get($_GET["id"]);

		if (!$survey)
			return $mapping->findForwardConfig('failure');

		//verificacion si solo debe ser visible para un usuario registrado
		//no es publica y no quiere acceder un usuario afiliado.
		if ((!$survey->isPublic()) && (!Common::isRegistrationUser()) && (!Common::isAdmin()))
			return $mapping->findForwardConfig('failure-visibility');

		$smarty->assign("survey",$survey);

		return $mapping->findForwardConfig('success');

	}

}