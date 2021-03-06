<?php

class SurveysAnswersListAction extends BaseAction {

	function SurveysAnswersListAction() {
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

		$pager = SurveyAnswerPeer::getAllPaginated($_GET["page"]);
		$smarty->assign("surveyanswers",$pager->getResult());
		$smarty->assign("pager",$pager);
		$url = "Main.php?do=surveysSurveyAnswersList";
		$smarty->assign("url",$url);

		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}
}