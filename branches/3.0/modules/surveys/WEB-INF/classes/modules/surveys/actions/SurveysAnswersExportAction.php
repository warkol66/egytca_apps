<?php

class SurveysAnswersExportAction extends BaseAction {

	function SurveysAnswersExportAction() {
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
		$section = "SurveyAnswers";
		$smarty->assign("section",$section);

		$survey = SurveyPeer::get($_POST["id"]);

		if (!$survey)
			return $mapping->findForwardConfig('failure');

		$surveyQuestions = $survey->getSurveyQuestions();
		
		$content = '';
		
		foreach ($surveyQuestions as $surveyQuestion) {
			$answerOptions = $surveyQuestion->getSurveyAnswerOptions();
			$content .= "'" . $surveyQuestion . "'\r\n";
			foreach ($answerOptions as $answerOption) {
				$count = $answerOption->getAnswerCount();
				$answer = $answerOption->getAnswer();
				$content .= "'".$answer."','".$count."'\r\n";
			}
		}

		$filename = str_replace(' ','_',strtolower($surveyQuestion->getQuestion()));
		header("Content-type: text/x-csv");
		header('Content-Disposition: attachment; filename="'.$survey->getId().'_'.$surveyQuestion->getId().'_'.$filename.'.csv'.'"');
		echo $content;

		die;

	}

}