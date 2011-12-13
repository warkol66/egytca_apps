<?php

class HtmlsDoDeleteAction extends BaseAction {

	function HtmlsDoDeleteAction() {
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

		$templatePath = "WEB-INF/tpl/";
		$fileName = $_POST["fileName"];

		if (is_file($templatePath . $fileName))
			$deleted = unlink($templatePath . $fileName);

		$smarty->assign("deleted",$deleted);
		if ($deleted)
			return $mapping->findForwardConfig('success');
		else
			return $mapping->findForwardConfig('failure');

	}

}
