<?php

class SurveysEditAction extends BaseAction {

	function SurveysEditAction() {
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
			//voy a editar un survey
			$survey = SurveyPeer::get($_GET["id"]);
			$smarty->assign("survey",$survey);
			$smarty->assign("action","edit");
		}
		else {
			//voy a crear un survey nuevo
			$survey = new Survey();
			$smarty->assign("survey",$survey);
			$smarty->assign("action","create");
		}

		$moduleNews = ModulePeer::get('news');
		if (!empty($moduleNews) && ($moduleNews->getActive() == 1)) {
			//existe el modulo de noticias
			$smarty->assign('articles',NewsArticlePeer::getLastArticles(50));
			$smarty->assign('hasNews',true);
		}

		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}