<?php

class SurveysQuestionsDoEditAction extends BaseAction {

	function SurveysQuestionsDoEditAction() {
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

		$params = $_POST['surveyQuestion'];

		if (!empty($_POST["id"])) {
			//voy a editar un surveyQuestion
			$surveyQuestion = SurveyQuestionPeer::get($_POST["id"]);
			$smarty->assign("action","edit");
		}
		else {
			//voy a crear un survey nuevo
			$surveyQuestion = new SurveyQuestion;
			$smarty->assign("action","create");
		}

		switch ($_POST['surveyType']) {

			case 'yesno':
				$surveyQuestion = SurveyQuestionPeer::createYesNoQuestion($params, $surveyQuestion);
				break;

			case 'multipleAnswers':
				$params['multipleAnswer'] = 1;
				Common::setObjectFromParams($surveyQuestion, $params);
				$surveyQuestion->save();
				break;

			case 'oneAnswer':
				$params['multipleAnswer'] = 0;
				Common::setObjectFromParams($surveyQuestion, $params);
				$surveyQuestion->save();
				break;
		}

		$smarty->assign("surveyQuestion",$surveyQuestion);
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}
}