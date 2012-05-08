<?php

class PositionsVersionsEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function PositionsVersionsEditAction() {
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

		$module = "Positions";
		$smarty->assign("module",$module);
		
		if ( !empty($_GET["id"]) ) {
			$positionVersion = PositionVersionPeer::get($_GET["id"]);
		}
		else {
			//voy a crear una version nueva
			$positionVersion = new PositionVersion();
		}

		$smarty->assign("positionVersion",$positionVersion);

		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}

