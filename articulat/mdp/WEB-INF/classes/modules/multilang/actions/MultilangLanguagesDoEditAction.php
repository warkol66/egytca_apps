<?php

class MultilangLanguagesDoEditAction extends BaseAction {

	function MultilangLanguagesDoEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$modulo = "Multilang";

		if ($_POST["action"] == "edit") {
			if (MultilangLanguagePeer::update($_POST["id"],$_POST["name"],$_POST["code"],$_POST["locale"]))
				return $mapping->findForwardConfig('success');
			else
				return $mapping->findForwardConfig('success');
		}
		else {
			if (!MultilangLanguagePeer::create($_POST["name"],$_POST["code"],$_POST["locale"])) {
				$smarty->assign("id",$_POST["id"]);
				$smarty->assign("name",$_POST["name"]);
				$smarty->assign("code",$_POST["code"]);
				$smarty->assign("locale",$_POST["locale"]);
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				return $mapping->findForwardConfig('failure');
			}
			Common::doLog("success",$_POST["name"]);
			return $mapping->findForwardConfig('success');
		}
	}

}
