<?php

class MultilangTextsDumpAction extends BaseAction {

	function MultilangTextsDumpAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

   	BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Multilang";
    $smarty->assign("module",$module);

  	$appLanguages = MultilangLanguagePeer::getAll();
  	$smarty->assign("appLanguages",$appLanguages);
		$modules = ModulePeer::getAllPresent();
		$smarty->assign('modules',$modules);

		$smarty->assign("moduleName",$_GET["moduleName"]);
		$smarty->assign("languageCodes",$_GET["languageCodes"]);

		return $mapping->findForwardConfig('success');
	}

}
