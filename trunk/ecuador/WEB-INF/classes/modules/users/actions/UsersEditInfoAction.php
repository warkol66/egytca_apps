<?php

class UsersEditInfoAction extends BaseAction {

	function UsersEditInfoAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Users";
		$section = "Users";
		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		//timezone
		require_once('TimezonePeer.php');
		$timezonePeer = new TimezonePeer();
		$timezones = $timezonePeer->getAll();
		
		$smarty->assign("timezones",$timezones);

		$smarty->assign("message",$_GET["message"]);

		$smarty->assign("currentUser",Common::getLoggedUser());
		$smarty->assign("editInfo",true);

		$smarty->assign("filters",$_GET["filters"]);
		$smarty->assign("page",$_GET["page"]);

		$this->template->template = "TemplatePublic.tpl";

		return $mapping->findForwardConfig('success');

	}

}