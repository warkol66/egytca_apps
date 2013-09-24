<?php

require_once 'TwitterConnection.class.php';

class TwitterTrendingTopicsSearchXAction extends BaseAction {
	
	public function execute($mapping, $form, &$request, &$response) {
		
		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$config = json_decode(file_get_contents(__DIR__.'/../config.json'), true);
		$twitterConnection = new TwitterConnection($config);
		
		//seteo el id para argentina
		$query = array('id' => 23424747);
		if (!empty($query)) {
			
			$trendingTopics = array();
			
			$searchRespone = $twitterConnection->search($query,0,'trends');
			
			echo "<pre>";print_r($searchRespone);echo "</pre>";
		}
		die;
		$smarty->assign('tweetsParsed',$tweets);
		return $mapping->findForwardConfig('success');
	}
}


