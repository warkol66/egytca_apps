<?php

class IndicatorsXsEditAction extends BaseAction {

	function IndicatorsXsEditAction() {
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
		if ($_REQUEST['disbursement']){
			$smarty->assign("disbursement",true);
			$smarty->assign("module","Projects");
		}

		$indicatorsPeer = new IndicatorPeer();
		$indicatorsTypes = $indicatorsPeer->getIndicatorTypesTranslated();
		$smarty->assign("indicatorsTypes",$indicatorsTypes);
		if ( !empty($_GET["id"]) ) {
			$indicator = IndicatorPeer::get($_GET["id"]);
			$smarty->assign("indicator",$indicator);
			$smarty->assign("action","edit");
		}
		else {
			//voy a crear un indicator nuevo
			$indicator = new Indicator();
			$smarty->assign("indicator",$indicator);
			$smarty->assign("action","create");
		}
		

		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
