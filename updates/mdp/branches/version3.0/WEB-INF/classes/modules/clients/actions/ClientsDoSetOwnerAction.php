<?php

class ClientsDoSetOwnerAction extends BaseAction {

	function ClientsDoSetOwnerAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Clients";
		$smarty->assign("module",$module);

		if ($_POST['userId'] && $_POST['clientId']) {
			$client = ClientPeer::get($_POST['clientId']);
			$client->setOwnerId($_POST['userId']);
			try {
				$client->save();
			}
			catch (PropelException $exp) {
				if (ConfigModule::get("global","showPropelExceptions"))
					print_r($exp->getMessage());
				return $mapping->findForwardConfig('failure');
			}
		}
		return $mapping->findForwardConfig('success');
	}
}
