<?php

class IssuesDoEditXAction extends BaseAction {

	function IssuesDoEditXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$issue = new Issue();
		$issue = Common::setObjectFromParams($issue,$_POST["params"]);
		if (!$issue->save())
			return $mapping->findForwardConfig('failure');			

		if (mb_strlen($_POST["params"]["name"]) > 120)
			$cont = " ... ";

		$logSufix = "$cont, " . Common::getTranslation('action: create','common');
		Common::doLog('success', substr($_POST["params"]["name"], 0, 120) . $logSufix);

		return $mapping->findForwardConfig('success');			

	}

}
