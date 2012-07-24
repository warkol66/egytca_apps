<?php

class HeadlinesParsedDiscardXAction extends BaseAction {

	function HeadlinesParsedDiscardXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Headlines";
		$smarty->assign("module",$module);

		if (!empty($_GET["id"])) {
			$headline = HeadlineParsedQuery::create()->findOneById($_GET["id"]);
			if (!is_null($headline)) {
				$headline->setStatus(HeadlineParsedQuery::STATUS_DISCARDED);
				if($headline->isModified() && $headline->save()) {
					$smarty->assign("headline",$headline);
					return $mapping->findForwardConfig('success');
				}
			}
		}
		return $mapping->findForwardConfig('failure');
	}
}
