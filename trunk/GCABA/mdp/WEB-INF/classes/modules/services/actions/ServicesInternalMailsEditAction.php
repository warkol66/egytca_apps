<?php

class ServicesInternalMailsEditAction extends BaseAction {

	function ServicesInternalMailsEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

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
