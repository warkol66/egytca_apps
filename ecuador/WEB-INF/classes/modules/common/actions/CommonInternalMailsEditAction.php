<?php

class CommonInternalMailsEditAction extends BaseAction {

	function CommonInternalMailsEditAction() {
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
		
		if (!empty($_GET["replyId"])) {
			//Generamos una respuesta base.
			$internalMail = InternalMailPeer::generateReply($_GET["replyId"], $_GET["replyToAll"]);
		} else {
			//No existe la edición de mensajes, solo creación.
			$internalMail = new InternalMail;
		}
		
		$smarty->assign("internalMail", $internalMail);

		$smarty->assign("filters", $_GET["filters"]);
		$smarty->assign("page", $_GET["page"]);
		$smarty->assign("message", $_GET["message"]);

		return $mapping->findForwardConfig('success');
	}
}
