<?php

class MultilangLanguagesListAction extends BaseAction {

	function MultilangLanguagesListAction() {
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
		$smarty->assign('module',$module);

		$languages = MultilangLanguagePeer::getAll();
		$smarty->assign("languages",$languages);
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
