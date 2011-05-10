<?php

class SurveysAffiliatesUsersFillBranchesSurveyAction extends BaseAction {

	function SurveysAffiliatesUsersFillBranchesSurveyAction() {
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

		$module = "Affiliates";
		$section = "Users";

  		$smarty->assign("module",$module);
  		$smarty->assign("section",$section);

		$affiliateUser = $_SESSION["loginAffiliateUser"];
		if (empty($affiliateUser))
			return $mapping->findForwardConfig('failure');
			
		$moduleSurveys = ModulePeer::get('surveys');
		if (!ModulePeer::existsModule('surveys') || empty($moduleSurveys) || ($moduleSurveys->getActive() != 1)) {
			//no existe el modulo de encuestas.
			return $mapping->findForwardConfig('failure');
		}
		
		$survey = SurveyPeer::get($_GET['id']);
		
		if (empty($survey))
			return $mapping->findForwardConfig('failure');
			
		//Se supone que no va a haber más de un affiliado que tenga como dueño a este user.
		$affiliate = $affiliateUser->getAffiliatesRelatedByOwnerid()->getFirst();
		
		if (empty($affiliate))
			return $mapping->findForwardConfig('failure');
			
		$branches = $affiliate->getAffiliateBranchs();
		
		$smarty->assign('branches', $branches);
		$smarty->assign('survey', $survey);
		
		return $mapping->findForwardConfig('success');
	}
}
