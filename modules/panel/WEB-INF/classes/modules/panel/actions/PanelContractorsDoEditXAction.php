<?php

class PanelContractorsDoEditXAction extends BaseAction {

	function PanelContractorsDoEditXAction() {
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

		$contractor = new Contractor();
		$contractor = Common::setObjectFromParams($contractor,$_POST["params"]);
		if (!$contractor->save()){
			$smarty->assign("contractor",$contractor);
			$smarty->assign("action","create");
			$smarty->assign("message","error");
			return $mapping->findForwardConfig('failure');
		}

		$smarty->assign("contractor",$contractor);

		$logSufix = ', ' . Common::getTranslation('action: create','common');
		Common::doLog('success', $_POST["params"]["name"] . $logSufix);

		return $mapping->findForwardConfig('success');

	}

}
