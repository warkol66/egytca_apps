<?php

class SurveysShowAction extends BaseAction {

	function SurveysShowAction() {
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

// comentado por problemas con el modulo de banners
//	    if (!isset($_SESSION["login_user"]))
//				$this->template->template = "TemplatePublic.tpl";

		$survey = SurveyPeer::get($_GET["id"]);

		if (!$survey)
			return $mapping->findForwardConfig('failure');

		if ($survey->hasExpired()) {
			$smarty->assign('surveyExpired',true);
		}
		if ($_GET["forcedForm"] == 1)
			$smarty->assign('forcedForm',true);

		//verificacion si solo debe ser visible para un usuario registrado
		//no es publica y no quiere acceder un usuario afiliado.
		if ((!$survey->isPublic()) && (!Common::isRegistrationUser()) && ($_GET["forcedForm"] != 1))
			return $mapping->findForwardConfig('failure-visibility');

		//verificamos la existencia del cookie para ver si el usuario no ha respondido ya
		//la encuesta
		$cookieName = SurveyPeer::getCookieName($survey->getId(), $_GET['objectType'], $_GET['objectId']);
		$cookie = $_COOKIE[$cookieName];
		if (!empty($cookie) && $cookie == $survey->getId()) {
			//la encuesta ya fue respondida
			$smarty->assign('alreadyAnswered',true);
		}

		//verifico la utilizacion de captcha para construir la opcion en la vista
		if (Common::getSurveysCaptchaUse()) {
			$smarty->assign('useCaptcha',true);
		}

		$smarty->assign("survey",$survey);
		$smarty->assign('objectType', $_GET['objectType']);
		$smarty->assign('objectId', $_GET['objectId']);

		return $mapping->findForwardConfig('success');

	}

}