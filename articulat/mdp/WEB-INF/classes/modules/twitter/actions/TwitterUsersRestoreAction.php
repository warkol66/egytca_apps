<?php

require_once 'TwitterConnection.class.php';

class TwitterUsersRestoreAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('TwitterUser');
	}
	
	protected function preList() {
		parent::preList();

		$this->module = "Twitter";
		$this->filters['brokenUser'] = 1;
		
	}

	protected function postList() {
		parent::postList();
		
		if($this->results){
		
			$config = json_decode(file_get_contents(__DIR__.'/../config.json'), true);
			$twitterConnection = new TwitterConnection($config);
			
			echo "<pre>";
			// restore action
			$i = 0;
			foreach($this->results as $twitterUser){
				if ($i == 50)
						break;
				$query = array('user_id' => $twitterUser->getTwitteruserid());

				if (!empty($query)) {
					$searchRespone = $twitterConnection->search($query,0,'users');
					
					if(empty($searchRespone->errors))
						$twitterUser->updateFromTwitter($searchRespone);
						print_r($twitterUser);
				}
				$i++;
			}
			
			echo "</pre>";
			die;
		}
	}

}
