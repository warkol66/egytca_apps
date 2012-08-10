<?php

class PositionsDoDeleteAction extends BaseAction {

	function PositionsDoDeleteAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Positions";

		$position = PositionQuery::create()->findOneById($_POST["id"])->delete();

		return $mapping->findForwardConfig('success');

	}

}
