<?php

class IndicatorsViewAction extends BaseAction {

	function IndicatorsViewAction() {
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

		$module = "Indicators";
		$smarty->assign("module",$module);

		if ( !empty($_GET["id"]) ) {
			if (!empty($_GET["entity"])) {
				$indicator = IndicatorPeer::getDisbursementIndicator($_GET["entity"], $_GET["id"]);
				$smarty->assign("entity",$_GET["entity"]);
				$smarty->assign("entityId",$_GET["id"]);

				$entityPeer = $_GET["entity"] . "Peer";
				$entityObj = $entityPeer::get($_GET["id"]);
				$smarty->assign("entityObj",$entityObj);

				$disbursement = true;
			} 
			else
				$indicator = IndicatorPeer::get($_GET["id"]);

			$smarty->assign("indicator",$indicator);
		}
		
		$categories = $indicator->getIndicatorCategorys();

		foreach ($categories as $category)
			if ($category->getId() == -1)
				$disbursement = true;
		$smarty->assign("disbursement",$disbursement);

		$smarty->assign("message",$_GET["message"]);
		return $mapping->findForwardConfig('success');
	}

}


