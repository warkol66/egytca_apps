<?php

class HeadlinesParsedDiscardAllXAction extends BaseAction {

	function HeadlinesParsedDiscardAllXAction() {
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
								->update(array('Status' => HeadlineParsedQuery::STATUS_DISCARDED));
			}
		} else if (!empty($_POST['headlinesIds'])) {
			$headlinesParsed = HeadlineParsedQuery::create()
				->filterById($_POST['headlinesIds'])
				->filterByStatus(array('max' => HeadlineParsedQuery::STATUS_PROCESSING))
				->update(array('Status' => HeadlineParsedQuery::STATUS_DISCARDED));

			$smarty->assign('selectiveDiscard', '1');
			$smarty->assign('headlinesIds', $_POST['headlinesIds']);
		} else {
			return $mapping->findForwardConfig('failure');
		}
		
		return $mapping->findForwardConfig('success');
	}
}
