<?php

class HeadlinesDoRemoveClippingXAction extends BaseAction {

	function execute($mapping, $form, &$request, &$response) {
		
		parent::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Headlines";

		if (!(empty($_POST["id"]))) {
			$headline = HeadlineQuery::create()->findOneById($_POST["id"]);
			$headline->deleteClipping();
			return;
		}

		return $this->returnAjaxFailure('invalid id');
	}

}

