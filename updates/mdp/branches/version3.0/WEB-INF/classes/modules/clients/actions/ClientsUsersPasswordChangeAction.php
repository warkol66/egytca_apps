<?php
/** 
 * ClientsUsersPasswordChangeAction
 *
 * @package clients 
 */

class ClientsUsersPasswordChangeAction extends BaseAction {

	function ClientsUsersPasswordChangeAction() {
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
		$section = "Clients";
		
		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		//timezone
		$timezonePeer = new TimezonePeer();
		$smarty->assign("timezones",$timezonePeer->getAll());	

    $smarty->assign("message",$_GET["message"]);
    $smarty->assign("firstLogin",$_GET["firstLogin"]);

		$smarty->assign("currentUser",$_SESSION["loginClientUser"]);

		return $mapping->findForwardConfig('success');
	}

}
