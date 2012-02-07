<?php

class ProfilesFormListAction extends BaseAction {

	function ProfilesFormListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Profiles";
		$section = "Configure";

		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		$module = "Profile";
		$section = "Forms";
    $smarty->assign("module",$module);
    $smarty->assign("section",$section);

		$filters = $_GET["filters"];
		$smarty->assign("filters",$filters);

		$message = $_GET["message"];
		$smarty->assign("message",$message);

		if ($_GET["page"] > 0)
			$smarty->assign("page",$_GET["page"]);

		$forms = FormQuery::create()->find();
		$smarty->assign("forms",$forms);

		return $mapping->findForwardConfig('success');
	}

}
