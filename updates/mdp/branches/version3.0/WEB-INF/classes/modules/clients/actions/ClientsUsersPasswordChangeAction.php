<?php
/** 
 * ClientsUsersPasswordChangeAction
 *
 * @package clients 
 */

require_once("TimezonePeer.php");

class ClientsUsersPasswordChangeAction extends BaseAction {

	function ClientsUsersPasswordChangeAction() {
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
