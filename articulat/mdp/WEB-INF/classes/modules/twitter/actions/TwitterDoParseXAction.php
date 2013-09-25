<?php

require_once 'TwitterConnection.class.php';

class TwitterDoParseXAction extends BaseAction {
	
	public function execute($mapping, $form, &$request, &$response) {
		
		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$config = json_decode(file_get_contents(__DIR__.'/../config.json'), true);
		$twitterConnection = new TwitterConnection($config);
		
		$query = $_POST['q'];
		$campaignId = $_POST['campaignId'];
		if (!empty($query)) {
			
			$tweets = array();
			
			foreach (split(' ', $query) as $term) {
			
				$searchRespone = $twitterConnection->search($term,10,'search');
				foreach ($searchRespone->statuses as $responseTweet) {
					$tweet = TwitterTweet::createFromApiTweet($responseTweet, $campaignId);
					//$tweet->save();
					$tweets[] = $tweet;
				}
			}
			
			//echo "<pre>";print_r($tweets);echo "</pre>";
		}
		//die;
		$smarty->assign('tweetsParsed',$tweets);
		return $mapping->findForwardConfig('success');
	}
}
