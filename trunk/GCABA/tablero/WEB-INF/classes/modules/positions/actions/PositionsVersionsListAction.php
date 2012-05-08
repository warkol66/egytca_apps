<?php

class PositionsVersionsListAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function PositionsVersionsListAction() {
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
		
		$pager = PositionVersionPeer::getAllPaginated($_GET["page"]);
		$smarty->assign("versions",$pager->getResult());
		$smarty->assign("pager",$pager);

		$smarty->assign("message",$_GET["message"]);		

		return $mapping->findForwardConfig('success');
	}

}


