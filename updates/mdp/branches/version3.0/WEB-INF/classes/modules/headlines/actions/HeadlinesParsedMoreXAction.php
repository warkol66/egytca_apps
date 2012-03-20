<?php

class HeadlinesParsedMoreXAction extends BaseAction {

	function HeadlinesParsedMoreXAction() {
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
				
				require 'contentProvider/HeadlineContentProvider.php';
				
				$provider = HeadlineContentProvider::create('', $headline->getCampaignid())
					->setStrategy($headline->getStrategy());
				
				$headlinesParsed = $provider->findMore($_GET['id']);
				$smarty->assign('headlinesParsed', $headlinesParsed);
				
				$parseErrors = $provider->getErrors();
				$smarty->assign('parseErrors', $parseErrors);
				
				return $mapping->findForwardConfig('success');
				
			} else {
				throw new Exception('invalid ID');
			}
		}
		return $mapping->findForwardConfig('failure');
	}
}
