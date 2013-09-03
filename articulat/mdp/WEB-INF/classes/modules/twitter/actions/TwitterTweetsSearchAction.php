<?php

class TwitterTweetsSearchAction extends BaseAction {
	
	public function execute($mapping, $form, &$request, &$response) {
		
		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$config = json_decode(file_get_contents(__DIR__.'/../config.json'), true);
		$twitterConnection = new TwitterConnection($config);
		
		$query = $_GET['q'];
		if (!empty($query)) {
			
			$tweets = array();
			
			$searchRespone = $twitterConnection->search($query);
			foreach ($searchRespone->statuses as $responseTweet) {
				$tweet = createFromApiTweet($responseTweet);
//				$tweet->save();
				$tweets[] = $tweet;
			}
			
			echo "<pre>";print_r($tweets);echo "</pre>";
		}
		die;
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

// este metodo deberia ser TwitterTweet::createFromApiTweet($apiTweet); pero no está commiteada
function createFromApiTweet($apiTweet) {
	
	$tweet = new TwitterTweet();
	$tweet->fromArray(array(
//		'Createdat' => $apiTweet->created_at,
		'Tweetid' => $apiTweet->id,
		'Tweetidstr' => $apiTweet->id_str,
//		'Internalid' => 
//		'Campaignid' => TODO: no faltaria esto?
		'Text' => $apiTweet->text,
		'Truncated' => $apiTweet->truncated,
		'Inreplytostatusid' => $apiTweet->in_reply_to_status_id,
		'Inreplytostatusidstr' => $apiTweet->in_reply_to_status_id_str,
		'Inreplytouserid' => $apiTweet->in_reply_to_user_id,
		'Inreplytouseridstr' => $apiTweet->in_reply_to_user_id_str,
		'Inreplytoscreenname' => $apiTweet->in_reply_to_screen_name,
//		'Geo' => $apiTweet->geo,
//		'Coordinates' => $apiTweet->coordinates,
//		'Contributors' => $apiTweet->contributors,
		'Place' => $apiTweet->place,
		'Retweetcount' => $apiTweet->retweet_count,
		'Favoritecount' => $apiTweet->favorite_count,
		'Lang' => $apiTweet->lang
	));

//	$user = TODO: create user
//	$tweet->addUser($user);
	
	// TODO: otras entidades
	
	return $tweet;
}