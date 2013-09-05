<?php

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
			
			$searchRespone = $twitterConnection->search($query);
			foreach ($searchRespone->statuses as $responseTweet) {
				$tweet = TwitterTweet::createFromApiTweet($responseTweet, $campaignId);
				//$tweet->save();
				$tweets[] = $tweet;
			}
			
			//echo "<pre>";print_r($tweets);echo "</pre>";
		}
		//die;
		$smarty->assign('tweetsParsed',$tweets);
		return $mapping->findForwardConfig('success');
	}
}


require_once 'twitteroauth/twitteroauth.php';

class TwitterConnection {
	
	const COUNT = 10;
	
	private $connection;
	
	public function __construct($config) {
		
		$this->connection = new TwitterOAuth(
			$config['consumerKey'],
			$config['consumerSecret'],
			$config['oauthToken'],
			$config['oauthSecret']
		);
	}
	
	function search($query, $count = self::COUNT) {
		
		if (is_null($query) || $query === '')
			throw new Exception('$query must be a non-empty value');
		
		$params = array('q' => $query, 'count' => $count);
		return $this->connection->get('search/tweets', $params);
	}
}

