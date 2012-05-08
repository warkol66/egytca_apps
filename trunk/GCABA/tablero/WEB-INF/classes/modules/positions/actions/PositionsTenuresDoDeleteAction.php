<?php

class PositionsTenuresDoDeleteAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function PositionsTenuresDoDeleteAction() {
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

		PositionTenurePeer::delete($_POST["id"]);

		return $this->addParamsToForwards(array("id" => $_POST["positionId"]),$mapping,'success');

	}

}
