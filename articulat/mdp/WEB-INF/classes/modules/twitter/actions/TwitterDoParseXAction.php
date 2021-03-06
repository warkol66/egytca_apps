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
		
		$queries = $_POST['q'];
		$campaignId = $_POST['campaignid'];


		if (!empty($queries)) {
			
			$tweets = array();
			$embeds = array();
			$system_tweets = array();
			
			foreach ($queries as $query) {
				
				if (empty($query))
					continue;
				
				$searchRespone = $twitterConnection->search($query,50,'search');
				if(empty($searchRespone->errors)){
					foreach ($searchRespone->statuses as $responseTweet) {
						// obtengo el html para embeber el tweet
						$embedQuery = array('id' => $responseTweet->id_str);
						$embed = $twitterConnection->search($embedQuery,0,'embed');
						//$embeds[] = $embed;
						$tweet = TwitterTweet::createFromApiTweet($responseTweet, $campaignId, $embed->html);
						
						if($tweet)
							$tweets[] = $tweet;
						/*else
							echo "duplicate";*/
						//$tweets[] = $responseTweet;
					}
				}else{
					TwitterLog::logTweetSearch(0, 0, $campaignId, $searchRespone->errors[0]->message);
				}
			}
			
			//echo "<pre>";print_r($tweets);echo "</pre>";
		}
		//die;
		$smarty->assign('tweetsParsed',$tweets);
		return $mapping->findForwardConfig('success');
	}
	
	function parseSearchQuery($query) {
		
		$loopcount = 0;
		$terms = array();
		
		while (preg_match('/^(\"[^\"]+\")|([^\"\s]+)/', trim($query), $matches)) {
			
			$match = empty($matches[1]) ? $matches[2] : $matches[1];
			$terms[] = $match;
			
			$query = preg_replace("/^$match\s*/", '', $query);
			
			if (++$loopcount > 1000)
				throw new Exception('potential infinite loop detected');
		}
		
		return $terms;
	}
}
