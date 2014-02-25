<?php

error_reporting(E_ALL -E_STRICT);
ini_set('display_errors', 1);

class CampaignsCorremeYBorrameAction extends BaseAction {
	
	public function execute($mapping, $form, &$request, &$response) {
		
		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		
		if (!$_POST['correr'])
			return $mapping->findForwardConfig('success');
		
		$campaigns = CampaignQuery::create()
			->filterByTwittercampaign(true)
			->find();
		
		$results = array();
		
		foreach ($campaigns as $campaign) {
			
			$result = array();
			
			$result['id'] = $campaign->getId();
				
			try {
				$newQuery = preg_replace("/\s/", ' OR ', $campaign->getDefaultKeywords());
				
				$result['old'] = $campaign->getDefaultKeywords();
				$result['new'] = $newQuery;
				
				$campaign->setSearchqueries(array($newQuery));
				$campaign->setDefaultkeywords(null);
				$campaign->save();
				
			} catch(Exception $e) {
				$result['error'] = $e->getMessage();
			}
			
			$results[] = $result;
		}
		
		$smarty->assign('results', $results);
		
		return $mapping->findForwardConfig('success');
	}
}
