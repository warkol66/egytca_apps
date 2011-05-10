<?php

class SurveysQuestionsDoDeleteAction extends BaseAction {

	function SurveysQuestionsDoDeleteAction() {
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

		if (!empty($_POST["id"])) {
			if (SurveyQuestionPeer::delete($_POST["id"]))
				$smarty->assign("message", 'ok');
			else
				$smarty->assign("message", 'error');
		}

		$smarty->assign($_POST["id"]);
		$smarty->assign('surveyId', $_POST["surveyId"]);

		return $mapping->findForwardConfig('success');
	}
}