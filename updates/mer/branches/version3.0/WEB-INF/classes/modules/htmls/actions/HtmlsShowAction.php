<?php

class HtmlsShowAction extends BaseAction {

	function HtmlsShowAction() {
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

		$name = $_GET["name"];

		if (file_exists("WEB-INF/tpl/htmls_".$name."_external.tpl"))
			$this->template->template = "htmls_".$name."_external.tpl";

		$smarty->assign("htmlFile","htmls_".$name.".tpl");

		return $mapping->findForwardConfig('success');

	}

}
