<?php

class MultilangLanguagesEditAction extends BaseAction {

	function MultilangLanguagesEditAction() {
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

		if (!empty($_GET["id"])) {
			$language = MultilangLanguagePeer::get($_GET["id"]);
			$smarty->assign("language",$language);
			$smarty->assign("action","edit");
		}
		else
			$smarty->assign("action","create");

		$smarty->assign("message",$_GET["message"]);
		return $mapping->findForwardConfig('success');
	}

}

