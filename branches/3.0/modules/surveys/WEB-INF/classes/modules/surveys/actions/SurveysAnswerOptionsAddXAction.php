<?php

class SurveysAnswerOptionsAddXAction extends BaseAction {

	function SurveysAnswerOptionsAddXAction() {
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

		$question = SurveyQuestionPeer::get($_POST['surveyAnswerOption']['questionId']);

		if (empty($question))
			return $mapping->findForwardConfig('failure');

		$answer = $question->addAnswerOption($_POST['surveyAnswerOption']['answer']);
		if (!$answer)
			return $mapping->findForwardConfig('failure');

		$smarty->assign('answerOption',$answer);
		return $mapping->findForwardConfig('success');
	}
}