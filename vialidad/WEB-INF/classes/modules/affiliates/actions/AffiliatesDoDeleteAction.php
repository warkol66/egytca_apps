<?php

class AffiliatesDoDeleteAction extends BaseAction {

	function AffiliatesDoDeleteAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Affiliates";

		$affiliate = AffiliateQuery::create()->findOneById($_GET["id"]);

		if (!empty($affiliate)) {
			if ($affiliate->delete())
				return $mapping->findForwardConfig('success');
			else
				return $mapping->findForwardConfig('failure');
			}
		else
			return $mapping->findForwardConfig('success');
	}

}
