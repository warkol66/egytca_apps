<?php

class IssuesDoEditXAction extends BaseAction {

	function IssuesDoEditXAction() {
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

		$this->template->template = 'TemplateAjax.tpl';

		$issue = new Issue();
		$issue = Common::setObjectFromParams($issue,$_POST["params"]);
		if (!$issue->save())
			return $mapping->findForwardConfig('failure');			

		$logSufix = ', ' . Common::getTranslation('action: create','common');
		Common::doLog('success', $_POST["params"]["name"] . $logSufix);

		return $mapping->findForwardConfig('success');			

	}

}
