<?php

class SurveysDoEditAction extends BaseAction {

	function SurveysDoEditAction() {
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

		if ( !empty($_POST['id']) ) {
			//estoy editando un survey existente
			$survey = SurveyPeer::get($_POST['id']);
			Common::setObjectFromParams($survey, $_POST["survey"]);

			if (!$survey->validate()) {
				$smarty->assign("survey",$survey);
				$smarty->assign("message","error");
				$smarty->assign("action","edit");
				return $mapping->findForwardConfig('failure');
			}
			$survey->save();

		} 
		else {
			//estoy creando un nuevo survey
			$survey = new Survey;
			Common::setObjectFromParams($survey, $_POST["survey"]);

			if (!$survey->validate()) {
				$smarty->assign("survey",$survey);
				$smarty->assign("message","error");
				$smarty->assign("action","create");
				return $mapping->findForwardConfig('failure');
			}
			$survey->save();
		}
		return $this->addParamsToForwards(array('id' => $survey->getId()), $mapping, 'success-add');
	}
}