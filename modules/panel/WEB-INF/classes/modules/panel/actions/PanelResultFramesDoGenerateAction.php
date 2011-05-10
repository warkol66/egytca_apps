<?php

class PanelResultFramesDoGenerateAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function PanelResultFramesDoGenerateAction() {
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
		
		if ($_POST["page"] > 0)
			$params["page"] = $_POST["page"];

		if (!empty($_POST["filters"]))
			$filters = $_POST["filters"];
		
		ResultFrameIndicatorPeer::createResultFrameFromCurrentEntities();

		return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');
	}		
}