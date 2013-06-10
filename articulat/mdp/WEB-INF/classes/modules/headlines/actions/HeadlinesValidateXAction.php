<?php

class HeadlinesValidateXAction extends BaseAction {

	function HeadlinesValidateXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Headlines";
		$smarty->assign("module",$module);
		
		$url = $_POST["params"]["url"];
		if (empty($url))
			$internalId = (md5($_POST["params"]["campaignId"] . $_POST["params"]["name"] . $_POST["params"]["content"] . $_POST["params"]["mediaId"]));
		else
			$internalId = (md5($_POST["params"]["campaignId"] . $_POST["params"]["name"] .  $_POST["params"]["url"]));
			
		$existent = HeadlineQuery::create()->findOneByInternalId($internalId);
		if(is_object($existent))
			$smarty->assign("existent", true);

		return $mapping->findForwardConfig('success');
	}
}
