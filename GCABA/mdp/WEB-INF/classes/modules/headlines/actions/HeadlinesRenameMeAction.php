<?php

class HeadlinesRenameMeAction extends BaseAction {
	
	public function execute($mapping, $form, &$request, &$response) {
		
		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$smarty->assign('allHeadlines', HeadlineQuery::create()->find());
		
		if (!empty($_GET['id'])) {
			
			$headline = HeadlineQuery::create()->findOneById($_GET['id']);
			if (!$headline) {
				$smarty->assign('invalidId', true);
				return $mapping->findForwardConfig('success');
			}
			
			$smarty->assign('headlineFrom', $headline);
		}
		
		return $mapping->findForwardConfig('success');
	}
}