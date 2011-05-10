<?php

class SurveysQuestionsEditAction extends BaseAction {

	function SurveysQuestionsEditAction() {
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

		if (!empty($_GET["id"])) {
			//voy a editar un surveyQuestion
			$surveyQuestion = SurveyQuestionPeer::get($_GET["id"]);
			$smarty->assign("surveyQuestion",$surveyQuestion);
				$smarty->assign("action","edit");
		}
		else {
			//voy a crear un survey nuevo
			$surveyQuestion = new SurveyQuestion();
			$smarty->assign("surveyQuestion",$surveyQuestion);
			$smarty->assign("action","create");
		}

		$smarty->assign('surveyId', $_GET["surveyId"]);
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}
}