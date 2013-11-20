<?php

require_once 'TwitterConnection.class.php';

class TwitterUsersUpdateAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('TwitterUser');
	}
	
	protected function preList() {
		parent::preList();

		$this->module = "Twitter";
		$this->notPaginated = true;

		$max = new DateTime('today');
		$max->modify('-5 days');
		$this->filters['updatedAt'] = array('max' => ($max));
	}

	protected function postList() {
		parent::postList();

		if ($this->results) {
			$config = json_decode(file_get_contents(__DIR__.'/../config.json'), true);
			$twitterConnection = new TwitterConnection($config);
			$i = 0;
			foreach ($this->results as $twitterUser) {
				if ($i == 50)
					break;
				$screenn = $twitterUser->getScreenname();
				if(!empty($screenn))
					$query = array('screen_name' => $screenn, 'user_id' => $twitterUser->getTwitteruserid());
				else
					$query = array('user_id' => $twitterUser->getTwitteruserid());

				if (!empty($query)) {
					$searchRespone = $twitterConnection->search($query,0,'users');
					$twitterUser->updateFromTwitter($searchRespone);
				}
				$i++;
			}
			die;
		}
	}

}
