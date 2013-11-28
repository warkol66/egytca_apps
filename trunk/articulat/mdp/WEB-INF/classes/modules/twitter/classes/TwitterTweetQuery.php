<?php
/**
 * Skeleton subclass for performing query and update operations on the 'twitter_tweet' table.
 *
 * Tweet
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.twitter.classes
 */
class TwitterTweetQuery extends BaseTwitterTweetQuery{
	
	public function maxStatus($status){
		return $this->filterByStatus(array('max' => $status));
	}
	
	/* Filtra por tweets procesados o no procesados
	 * @param $proc : bool - indica si quiero los procesados o los no
	 * 
	 * */
	public function Processed($proc){
		if($proc)
			return $this->filterByValue(array('min' => 1))->filterByRelevance(array('min' => 1));
		else
			return $this;
	}
	
	/* Filtra por tipo de tweets
	 * @param $type : int - indica el tipo de tweet a filtrar
	 * 
	 * */
	public function getByType($type){
		switch($type){
			case TwitterTweet::ORIGINAL:
				return $this->where('TwitterTweet.Inreplytostatusid IS NULL')->where('TwitterTweet.Inreplytouserid IS NULL')->filterByRetweeted(false);
			break;			
			case TwitterTweet::RETWEET:
				return $this->filterByRetweeted(true);
			break;
			case TwitterTweet::REPLY:
				return $this
					->condition('cond1', 'TwitterTweet.Inreplytostatusid IS NOT NULL')
					->condition('cond2', 'TwitterTweet.Inreplytouserid IS NOT NULL')
					->where(array('cond1', 'cond2'), 'or');
			break;
			default:
				return $this;
			break;		
		}
	}
	
	/* Filtra por tweets procesados y no aceptados
	 * @param $proc : bool - indica si quiero los procesados o los no
	 * 
	 * */
	public function parsedDiscarded($discarded){
		if($discarded)
			return $this
				->condition('cond1', 'TwitterTweet.Status = ?', TwitterTweet::PARSED)
				->condition('cond2', 'TwitterTweet.Status = ?', TwitterTweet::DISCARDED)
				->where(array('cond1', 'cond2'), 'or');
		else
			return $this->filterByStatus(TwitterTweet::PARSED);
	}
	
	/* Filtra segun campañas creadas en los ultimos n dias
	 * 
	 * */
	public function getMostRecent($campaigns){
		return TwitterTweetQuery::create()->filterByCampaignid($campaigns,Criteria::IN);
	}
	
	/* Obtiene cantidad de tweets aceptados y valorados como $value
	 * por dia
	 * 
	 * return (json) fecha y cantidad de tweets 
	 * */
	public function getAcceptedByValue($from = null, $to = null, $value){
		
		if(!isset($from) && !isset($to)){
			
			$positive = TwitterTweetQuery::create()
				->withColumn('count(TwitterTweet.Id)', 'tweets')
				->withColumn('CAST(TwitterTweet.Createdat as DATE)', 'date')
				->filterByStatus(TwitterTweet::ACCEPTED)
				->filterByValue($value)
				->groupBy('TwitterTweet.date')
				->select(array('date','tweets'))
				->find();
			
			$positiveTweets = array();
			$i = 0;
			foreach($positive as $pos){
				$positiveTweets[$i]['date'] = $pos['date'];
				$positiveTweets[$i]['tweets'] = $pos['tweets'];
				$i++;
			}
			
		}else{
			
		}
		return $positiveTweets;
	}
	
	public function getAllByValue($campaign, $from, $to, $value, $relevance, $type){
			
		$positive = TwitterTweet::POSITIVE;
		$neutral = TwitterTweet::NEUTRAL;
		$negative = TwitterTweet::NEGATIVE;
		//$values = getValues();
		if(empty($relevance)) 
			$relevance = array(0,TwitterTweet::RELEVANT,TwitterTweet::NEUTRALLY_RELEVANT,TwitterTweet::IRRELEVANT);
		if(empty($type)) 
			$type = 0;
		
		switch($value){
			case $positive:
				$byValue = TwitterTweetQuery::create()
					->filterByCampaignid($campaign)
					->filterByRelevance($relevance)
					->filterByCreatedat(array('min' => $from, 'max' => $to))
					->filterByStatus(TwitterTweet::ACCEPTED)
					->getByType($type)
					->withColumn('CAST(TwitterTweet.Createdat as DATE)', 'date')
					->withColumn('sum(if(TwitterTweet.Value = '. $positive .', 1, 0))', 'positive')
					->groupBy('TwitterTweet.date')
					->select(array('date','positive'))
					->find();
			break;
			case $neutral:
				$byValue = TwitterTweetQuery::create()
					->filterByCampaignid($campaign)
					->filterByRelevance($relevance)
					->filterByCreatedat(array('min' => $from, 'max' => $to))
					->filterByStatus(TwitterTweet::ACCEPTED)
					->getByType($type)
					->withColumn('CAST(TwitterTweet.Createdat as DATE)', 'date')
					->withColumn('sum(if(TwitterTweet.Value = '. $neutral .', 1, 0))', 'neutral')
					->groupBy('TwitterTweet.date')
					->select(array('date','neutral'))
					->find();
			break;
			case $negative:
				$byValue = TwitterTweetQuery::create()
					->filterByCampaignid($campaign)
					->filterByRelevance($relevance)
					->filterByCreatedat(array('min' => $from, 'max' => $to))
					->filterByStatus(TwitterTweet::ACCEPTED)
					->getByType($type)
					->withColumn('CAST(TwitterTweet.Createdat as DATE)', 'date')
					->withColumn('sum(if(TwitterTweet.Value = '. $negative .', 1, 0))', 'negative')
					->groupBy('TwitterTweet.date')
					->select(array('date','negative'))
					->find();
			break;
			default:
				$byValue = TwitterTweetQuery::create()
					->filterByRelevance($relevance)
					->filterByCampaignid($campaign)
					->filterByCreatedat(array('min' => $from, 'max' => $to))
					->filterByStatus(TwitterTweet::ACCEPTED)
					->getByType($type)
					->withColumn('CAST(TwitterTweet.Createdat as DATE)', 'date')
					->withColumn('sum(if(TwitterTweet.Value = '. TwitterTweet::POSITIVE .', 1, 0))', 'positive')
					->withColumn('sum(if(TwitterTweet.Value = '. TwitterTweet::NEUTRAL .', 1, 0))', 'neutral')
					->withColumn('sum(if(TwitterTweet.Value = '. TwitterTweet::NEGATIVE .', 1, 0))', 'negative')
					->groupBy('TwitterTweet.date')
					->select(array('date','positive', 'neutral', 'negative'))
					->find();
			break;
		}
		
		return $byValue;
	}
	
	/* Obtiene los tweets por valor para el reporte
	 * */
	public function getTweetsForReport($campaign, $from, $to, $value, $relevance, $type){
		if(empty($value)) 
			$value = array(0,TwitterTweet::POSITIVE,TwitterTweet::NEUTRAL,TwitterTweet::NEGATIVE);
		if(empty($relevance)) 
			$relevance = array(0,TwitterTweet::RELEVANT,TwitterTweet::NEUTRALLY_RELEVANT,TwitterTweet::IRRELEVANT);
		if(empty($type))
			$type = 0;
			
		TwitterTweetQuery::create()
			->filterByCampaignid($campaign)
			->filterByValue($value)
			->filterByRelevance($relevance)
			->filterByCreatedat(array('min' => $from, 'max' => $to))
			->filterByStatus(TwitterTweet::ACCEPTED)
			->getByType($type)
			->find();
	}
	
	public function getAllByRelevance($campaign, $from, $to, $value, $relevance, $type){
		
		$relevant = TwitterTweet::RELEVANT;
		$neutrally_relevant = TwitterTweet::NEUTRALLY_RELEVANT;
		$irrelevant = TwitterTweet::IRRELEVANT;
		if(empty($value)) 
			$value = array(0,TwitterTweet::POSITIVE,TwitterTweet::NEUTRAL,TwitterTweet::NEGATIVE);
		if(empty($type)) 
			$type = 0;
			
		switch($relevance){
			case $relevant:
				$byRelevance = TwitterTweetQuery::create()
					->withColumn('CAST(TwitterTweet.Createdat as DATE)', 'date')
					->withColumn('sum(if(TwitterTweet.Relevance = '. $relevant .', 1, 0))', 'relevant')
					->filterByCampaignid($campaign)
					->filterByValue($value)
					->filterByCreatedat(array('min' => $from, 'max' => $to))
					->filterByStatus(TwitterTweet::ACCEPTED)
					->getByType($type)
					->groupBy('TwitterTweet.date')
					->select(array('date','relevant'))
					->find();
			break;
			case $neutrally_relevant:
				$byRelevance = TwitterTweetQuery::create()
					->withColumn('CAST(TwitterTweet.Createdat as DATE)', 'date')
					->withColumn('sum(if(TwitterTweet.Relevance = '. $neutrally_relevant .', 1, 0))', 'neutrally_relevant')
					->filterByCampaignid($campaign)
					->filterByValue($value)
					->filterByCreatedat(array('min' => $from, 'max' => $to))
					->filterByStatus(TwitterTweet::ACCEPTED)
					->getByType($type)
					->groupBy('TwitterTweet.date')
					->select(array('date','neutrally_relevant'))
					->find();
			break;
			case $irrelevant:
				$byRelevance = TwitterTweetQuery::create()
					->withColumn('CAST(TwitterTweet.Createdat as DATE)', 'date')
					->withColumn('sum(if(TwitterTweet.Relevance = '. $irrelevant .', 1, 0))', 'irrelevant')
					->filterByCampaignid($campaign)
					->filterByValue($value)
					->filterByCreatedat(array('min' => $from, 'max' => $to))
					->filterByStatus(TwitterTweet::ACCEPTED)
					->getByType($type)
					->groupBy('TwitterTweet.date')
					->select(array('date','irrelevant'))
					->find();
			break;
			default:
				$byRelevance = TwitterTweetQuery::create()
					->withColumn('CAST(TwitterTweet.Createdat as DATE)', 'date')
					->withColumn('sum(if(TwitterTweet.Relevance = '. TwitterTweet::RELEVANT .', 1, 0))', 'relevant')
					->withColumn('sum(if(TwitterTweet.Relevance = '. TwitterTweet::NEUTRALLY_RELEVANT .', 1, 0))', 'neutrally_relevant')
					->withColumn('sum(if(TwitterTweet.Relevance = '. TwitterTweet::IRRELEVANT .', 1, 0))', 'irrelevant')
					->filterByCampaignid($campaign)
					->filterByValue($value)
					->filterByCreatedat(array('min' => $from, 'max' => $to))
					->filterByStatus(TwitterTweet::ACCEPTED)
					->getByType($type)
					->groupBy('TwitterTweet.date')
					->select(array('date','relevant', 'neutrally_relevant', 'irrelevant'))
					->find();
			break;
		}
		
		return $byRelevance;
	}
	
	public static function getTotalTweets($campaign, $from, $to){
		$totalTweets = TwitterTweetQuery::create()
			->filterByCampaignid($campaign)
			->filterByCreatedat(array('min' => $from, 'max' => $to))
			->filterByStatus(TwitterTweet::ACCEPTED)
			->find();
			
		return count($totalTweets);
	}
	/* Obtiene la cantidad de tweets de todas las combinaciones entre
	 * valores y relevancias
	 * */
	public function getCombinations($campaignId, $from, $to, $valueFilter, $relevanceFilter){
		
		$tempValues = TwitterTweet::getValues();
		$tempRelevances = TwitterTweet::getRelevances();
		
		if(!empty($valueFilter))
			$values[$valueFilter] = $tempValues[$valueFilter];
		else
			$values = $tempValues;
		if(!empty($relevanceFilter))
			$relevances[$relevanceFilter] = $tempRelevances[$relevanceFilter];
		else
			$relevances = $tempRelevances;

		$combinations = array();
		$i = 0;
		
		foreach($values as $value => $name){
			foreach($relevances as $relevance => $relName){
				
				$tweetsAmount = TwitterTweetQuery::create()
					->filterByCampaignid($campaignId)
					->filterByStatus(TwitterTweet::ACCEPTED)
					->filterByCreatedat(array('min' => $from, 'max' => $to))
					->filterByValue($value)
					->filterByRelevance($relevance)
					->find()
					->count();
				
				$combinations[$i]['name'] = $name . '-' . $relName;
				$combinations[$i]['value'] = $tweetsAmount;
				
				$i++;
			}
		}
		
		return $combinations;
	}
	
	public function getPersonalTrends($campaignId){
		require_once 'TwitterAnalyze.class.php';
		
		$timeline_bank = new timeline_bank();

		//punc that irrelevant to trends:
		$punc = TwitterTweet::getPunctuation();
		$stopwords = TwitterTweet::getStopWords();
		$last_id = 0;
		
		//$usage = memory_get_usage();
		
		// obtengo los tweets aceptados
		$tweets = TwitterTweetQuery::create()
			->filterByCampaignid($campaignId)
			->filterByStatus(TwitterTweet::ACCEPTED)
			->joinWith('TwitterTweet.TwitterUser')
			->select(array('TwitterTweet.Id','TwitterTweet.Text','TwitterUser.Screenname'))
			->limit(3000)
			->find()
			->toArray();
			
		//echo memory_get_usage() - $usage;
		/*echo "<pre>";
		print_r($tweets);
		echo "</pre>";
		die();*/
		
		//this is an error checking mechanism [sometimes twitter was returning faulty data]
		if(!empty($tweets)){

			//lets loop through each tweet
			foreach($tweets as $tweet){
		
				//the all-important words of the tweet
				$words_of_tweet = explode(" ",strtolower($tweet['TwitterTweet.Text']));
				
				$userdata = array("tweet_id" => $tweet['TwitterTweet.Id'], "screen_name" => $tweet['TwitterUser.Screenname']);
				
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

		}else{
			return false;
		}

		//this is the important function, it finds the trends
		return $timeline_bank->prioritize(0);
		
		//return $timeline_bank->result;
	
	}
}
