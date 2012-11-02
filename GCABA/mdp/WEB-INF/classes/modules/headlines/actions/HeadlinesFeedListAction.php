<?php

class HeadlinesFeedListAction extends BaseAction {

	function HeadlinesFeedListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Headlines";
		$smarty->assign("module",$module);
		
		
		$feedsDir = opendir(ConfigModule::get('headlines', 'feedBackupsPath'));
		$feeds = array();
		while ($entry = readdir($feedsDir)) {
			if (!is_dir($entry)) {
				$feeds []= str_replace('.zip', '', $entry);
			}
		}
		closedir($feedsDir);
		
		$logEntries = HeadlineParseLogEntryQuery::create()
			->filterById($feeds)
			->orderByCreatedAt(Criteria::ASC)
			->find();
		
		$smarty->assign('logEntries', $logEntries);
		return $mapping->findForwardConfig('success');
	}

}
