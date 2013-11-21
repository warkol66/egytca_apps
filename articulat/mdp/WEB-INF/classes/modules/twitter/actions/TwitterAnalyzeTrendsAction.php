<?php

require_once 'TwitterAnalyze.class.php';

class TwitterAnalyzeTrendsAction extends BaseAction {
	
	public function execute($mapping, $form, &$request, &$response) {
		
		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$campaign = CampaignQuery::create()->findOneById($_GET['campaignid']);
			
		$timeline_bank = new timeline_bank($_GET["user_id"]);

		//punc that irrelevant to trends:
		$punc = TwitterTweet::getPunctuation();
		$stopwords = TwitterTweet::getStopWords();
		$last_id = 0;
		
		//print_r($stopWords);

		$current_unix_time = time();
		
		$tweetsPager = TwitterTweetQuery::create()
			->filterByCampaignid($_GET['campaignid'])
			->filterByStatus(TwitterTweet::ACCEPTED)
			->paginate(1,100);
			
		
		
		for($page = 1; $page <= $tweetsPager->getLastPage(); $page ++){
			
			$tweetsPager = TwitterTweetQuery::create()
			->filterByCampaignid($_GET['campaignid'])
			->filterByStatus(TwitterTweet::ACCEPTED)
			->paginate($page,100);
			
			echo "<pre>";
			echo $page;
			print_r($tweetsPager);
			echo "</pre>";
			
			//this is an error checking mechanism [sometimes twitter was returning faulty data]
			if(!empty($tweetsPager)){

			//lets loop through each tweet
				foreach($tweetsPager as $tweet){

					//lets get the tweet data
					$text = $tweet->getText();
					$tweet_id = $tweet->getId();
			
					//the all-important words of the tweet
					$words_of_tweet = explode(" ",strtolower($text));
					
					//reset/start the last word variable for this tweet
					$last_word = "";
					
					//loop through each word of the tweet
					foreach($words_of_tweet as $word){
				
						//clean it
						$word = str_replace($punc, "", $word);
						
						switch($word[0]){//compare first character
						
						/*
						 *	The words of the tweet are divided by hashtag, mention, single word, and phrase
						 *  This allows for different weighting scales of each type
						 *  For example, a single word is weighted less than the occurance of a 2-word phrase
						 *  The idea behind this is that the more conscious the action, the more valuable we can weight it.
						 */ 
						
							case "#":
								if(strlen($word) > 1){
									$timeline_bank->insert_hashtag($userdata, $word);
								}
								$last_word = "";//reset [comment out if you are okay with a trend is "its #raining"]
							break;
							
							case "@":
								if(strlen($word) > 1){
									$timeline_bank->insert_mention($userdata, $word);
								}
								$last_word = "";//reset [comment out if you are okay with a trend is "hi @ThomasTommyTom"]
							break;
							
							default:
								if(!in_array($word, $stopwords)){//filter out the noise [common words]
									//echo $word;
									$timeline_bank->insert_word($userdata, $word);
									
									//its a word, now lets see if what was behind it was a word
									if(!empty($last_word)){
										//the last word was not a hashtag, a mention or noise
										$phrase = $last_word." ".$word;
										$timeline_bank->insert_phrase($userdata, $phrase);
									}
									
									$last_word = $word;//set to current word
								}else{
									$last_word = "";//reset
								}
							break;
						}
					}//end foreach word
					
				}//end foreach tweet

			}else
				echo "wrong data";
				
		}
		
		die();
			
		if($_GET["debug"] == 1){
			//$timeline_bank->print_discoveries();
			//$timeline_bank->print_user_stats();
		}

		//this is the important function, it finds the trends
		$timeline_bank->prioritize($_GET["debug"]);
		
		// TODO: guardar las tendencias en una tabla

		//simple debugger built in for natural printing of FINAL data
		if($_GET["debug"] == 1){
			Echo "Complete result <br />";
			$timeline_bank->print_result();
		}
		
		die;
		$smarty->assign('tweetsParsed',$tweets);
		return $mapping->findForwardConfig('success');

	}

}
