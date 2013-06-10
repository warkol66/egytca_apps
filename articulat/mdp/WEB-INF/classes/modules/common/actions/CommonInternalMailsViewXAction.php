<?php

class CommonInternalMailsViewXAction extends BaseAction {

	function CommonInternalMailsViewXAction() {
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

		$smarty->assign("filters", $_GET["filters"]);
		$smarty->assign("page", $_GET["page"]);
		$smarty->assign("message", $_GET["message"]);

		$internalMail = InternalMailPeer::get($_GET['id']);
		if (empty($internalMail))
			return $mapping->findForwardConfig('failure');

		$internalMail->markAsRead();
		$internalMail->save();

		$smarty->assign("internalMail", $internalMail);

		return $mapping->findForwardConfig('success');
	}
}
