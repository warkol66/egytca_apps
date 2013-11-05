<?php

require_once 'twitteroauth/twitteroauth.php';

class TwitterConnection {
	
	const COUNT = 100;
	
	private $connection;
	
	public function __construct($config) {
		
		$this->connection = new TwitterOAuth(
			$config['consumerKey'],
			$config['consumerSecret'],
			$config['oauthToken'],
			$config['oauthSecret']
		);
	}
	
	function search($query, $count = self::COUNT, $action) {
		
		if (is_null($query) || $query === '')
			throw new Exception('$query must be a non-empty value');
			
		if($count == 0)
			$count = self::COUNT;
		
		switch($action){
			case 'search':
				$url = 'search/tweets';
				$params = array('q' => $query, 'count' => $count);
			break;
			case 'trends':
				$url = 'trends/place';
				$params = $query;
			break;
			case 'users':
				$url = 'users/show';
				$params = $query;
			break;
			case 'embed':
				$url = 'statuses/oembed';
				$params = $query;
			break;
		}
			
		return $this->connection->get($url, $params);
	}
}
