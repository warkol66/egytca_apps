<?php

class HtmlsEditAction extends BaseAction {

	function HtmlsEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = 'HTMLS';
		$smarty->assign("module",$module);

		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');

	}

}
