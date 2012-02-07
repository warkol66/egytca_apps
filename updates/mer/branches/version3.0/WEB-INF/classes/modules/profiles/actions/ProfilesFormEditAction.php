<?php

class ProfilesFormEditAction extends BaseAction {

	function ProfilesFormEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Profile";
		$section = "Forms";
    $smarty->assign("module",$module);
    $smarty->assign("section",$section);

		if ($_GET["page"] > 0)
			$smarty->assign("page",$_GET["page"]);

		$filters = $_GET["filters"];
		$smarty->assign("filters",$filters);

		$message = $_GET["message"];
		$smarty->assign("message",$message);

		$form = new Form();

    if (!empty($_GET["id"])) {
			$form = FormQuery::create()->findPK($_GET["id"]);
			if (empty($form))
				$smarty->assign("notValidId",true);		
		}

		$smarty->assign("form",$form);
		return $mapping->findForwardConfig('success');
	}

}
