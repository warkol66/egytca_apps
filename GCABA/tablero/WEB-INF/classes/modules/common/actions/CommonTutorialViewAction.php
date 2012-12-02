<?php
/**
* CommonTutorialViewAction
*
* @package common
*/

class CommonTutorialViewAction extends BaseAction {

	function CommonTutorialViewAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$this->template->template = "TemplateBasic.tpl";

		$fileName = "tutoriales/" . $_GET["fileName"];
		global $appDir;
		$filePath = realpath($appDir."/".$fileName);

		if (!file_exists($filePath))
			$smarty->assign("nonExist",true);
		else
			$smarty->assign("fileName",$fileName);

		return $mapping->findForwardConfig('success');

	}

}
