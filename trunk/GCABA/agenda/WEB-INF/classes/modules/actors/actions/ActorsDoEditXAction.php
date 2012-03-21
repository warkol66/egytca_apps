<?php

class ActorsDoEditXAction extends BaseAction {

	function ActorsDoEditXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$this->template->template = 'TemplateAjax.tpl';

		$actor = new Actor();
		$actor = Common::setObjectFromParams($actor,$_POST["params"]);
		if (!$actor->save())
			return $mapping->findForwardConfig('failure');			

		$logSufix = ', ' . Common::getTranslation('action: create','common');
		Common::doLog('success', $_POST["params"]["surname"] . ", " . $_POST["params"]["name"] . $logSufix);

		return $mapping->findForwardConfig('success');			

	}

}
