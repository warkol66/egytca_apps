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
		$woeid = 23424747;
		$query = array('id' => $woeid);
		if (!empty($query)) {
			
			$trendingTopics = array();
			$date = date('Y-m-d H:i:s');
			
			$searchRespone = $twitterConnection->search($query,0,'trends');
			$searchRespone = $searchRespone[0];
			$order = 0;
			foreach ($searchRespone->trends as $responseTT) {
				$trendingTopic = TwitterTrendingTopic::createFromApiTT($responseTT, $woeid, $order, $date);
				$trendingTopics[] = $trendingTopic;
				$order++;
			}
			
			/*echo "<pre>"; print_r($trendingTopics); echo"</pre>";
			die;*/
			$smarty->assign('trendingTopics',$trendingTopics);
			return $mapping->findForwardConfig('success');	
		}
	}
}


