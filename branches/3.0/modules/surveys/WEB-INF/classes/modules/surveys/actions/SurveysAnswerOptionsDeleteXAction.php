<?php

class SurveysAnswerOptionsDeleteXAction extends BaseAction {

	function SurveysAnswerOptionsDeleteXAction() {
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

		//por ser una accion ajax
		$this->template->template = 'TemplateAjax.tpl';
		$module = "Surveys";
		$smarty->assign("module",$module);
		$section = "Surveys";
		$smarty->assign("section",$section);

		if (!SurveyAnswerOptionPeer::delete($_POST['answerOptionId'])) {
			return $mapping->findForwardConfig('failure');
		}

		$smarty->assign('answerOptionId',$_POST['answerOptionId']);

		return $mapping->findForwardConfig('success');
	}
}