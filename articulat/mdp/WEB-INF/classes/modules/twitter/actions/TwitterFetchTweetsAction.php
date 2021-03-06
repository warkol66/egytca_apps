<?php

require_once 'TwitterConnection.class.php';

class TwitterFetchTweetsAction extends BaseAction {
	
	public function execute($mapping, $form, &$request, &$response) {
		
		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$config = json_decode(file_get_contents(__DIR__.'/../config.json'), true);
		$twitterConnection = new TwitterConnection($config);
		
		// obtengo las campaigns activas
		$activeCampaigns = CampaignQuery::getTwitterActive();
		
		/*print_r($activeCampaigns);
		die();*/
		
		// busco tweets y usuarios para cada una
		foreach($activeCampaigns as $campaign){
			
			$query = $campaign->getDefaultkeywords();
			$campaignId = $campaign->getId();
			if (!empty($query)) {
				
				$tweets = array();
				$embeds = array();
				$system_tweets = array();
				
				$terms = $this->parseSearchQuery($query);
				foreach ($terms as $term) {
				
					$searchRespone = $twitterConnection->search($term,50,'search');
					if(empty($searchRespone->errors)){
						foreach ($searchRespone->statuses as $responseTweet) {
							// obtengo el html para embeber el tweet
							$embedQuery = array('id' => $responseTweet->id_str);
							$embed = $twitterConnection->search($embedQuery,0,'embed');
							$embed = $embed->html;
							//$embeds[] = $embed;
							$tweet = TwitterTweet::createFromApiTweet($responseTweet, $campaignId, $embed);
							
							$tweets[] = $tweet;
							//$tweets[] = $responseTweet;
						}
						
						TwitterLog::logTweetSearch(count($tweets), 0, $campaignId, 'no error');
						
					}else{
						// logueo el error
						TwitterLog::logTweetSearch(0, 0, $campaignId, $searchRespone->errors[0]->message);
					}
				}
				
				//echo "<pre>";print_r($tweets);echo "</pre>";
			}
			
			
		}
		
		// obtengo tts
		$woeid = 23424747; // woeid de argentina
		$query = array('id' => $woeid);
		if (!empty($query)) {
			
			$trendingTopics = array();
			$date = date('Y-m-d H:i:s');
			
			$ttsRespone = $twitterConnection->search($query,0,'trends');
			if(empty($ttsRespone->errors)){
				$ttsRespone = $ttsRespone[0];
				$order = 0;
				foreach ($ttsRespone->trends as $response) {
					$trendingTopic = TwitterTrendingTopic::createFromApiTT($response, $woeid, $order, $date);
					$trendingTopics[] = $trendingTopic;
					$order++;
				}
				
				TwitterLog::logTweetSearch(0, count($trendingTopics), null, 'no error');
				
			}else{
				TwitterLog::logTweetSearch(0, count($trendingTopics), null, $ttsRespone->errors[0]->message);
			}
			
		}

		
		/*echo "tweetsCount: " . $tweetsCount;
		echo "ttsCount: " . $ttsCount;*/

		//die;
		/*$smarty->assign('tweetsParsed',$tweets);
		return $mapping->findForwardConfig('success');*/
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
