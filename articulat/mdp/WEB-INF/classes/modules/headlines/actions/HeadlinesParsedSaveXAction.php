<?php

class HeadlinesParsedSaveXAction extends BaseAction {

	function HeadlinesParsedSaveXAction() {
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
			$headlineParsed = HeadlineParsedQuery::create()->findOneById($_GET["id"]);
			if (!is_null($headlineParsed)) {
				try {
					$headlineParsed->accept();
				} catch (Exception $e) {
					return $mapping->findForwardConfig('failure');
				}
				
				$smarty->assign("headline",$headlineParsed);
				return $mapping->findForwardConfig('success');
			}
		}
		return $mapping->findForwardConfig('failure');
	}
}
