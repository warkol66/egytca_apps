<?php

class HeadlinesParsedSaveAllXAction extends BaseAction {

	function HeadlinesParsedSaveAllXAction() {
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
			$campaign = CampaignQuery::create()->findOneById($_GET["id"]);
			if (!is_null($campaign)) {
				
				$headlinesParsed = HeadlineParsedQuery::create()
								->filterByCampaign($campaign)
								->filterByStatus(array('max' => HeadlineParsedQuery::STATUS_PROCESSING))
								->find();
			}
		} else if (!empty($_POST['headlinesIds'])) {
			$headlinesParsed = HeadlineParsedQuery::create()
				->filterById($_POST['headlinesIds'])
				->filterByStatus(array('max' => HeadlineParsedQuery::STATUS_PROCESSING))
				->find();
			
			$smarty->assign('selectiveSave', '1');
			$smarty->assign('headlinesIds', $_POST['headlinesIds']);
		} else {
			$smarty->assign('errorMessage', 'invalid params');
			return $mapping->findForwardConfig('success');
		}
		
		try {
			foreach($headlinesParsed as $headlineParsed) {
				$headlineParsed->accept();
			}
		} catch (Exception $e) {
			$smarty->assign('errorMessage', "error: ".$e->getMessage());
			return $mapping->findForwardConfig('success');
		}
		
		return $mapping->findForwardConfig('success');
	}
}
