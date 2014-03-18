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
	
	/**
	 * filtra por estado de retweet: es un retweet o no
	 */
	public function filterByIsRetweet($condition = true) {
		$criteria = $condition ? Criteria::ISNOTNULL : Criteria::ISNULL;
		return $this->filterByRetweetedfromidstr(null, $criteria);
	}
	
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
	
	/* Filtra por tweets con el texto $personal
	 * @param $proc : bool - indica si quiero los procesados o los no
	 * 
	 * */
	public function textLike($personal){
		return $this->filterByText("%$personal%", Criteria::LIKE);
	}
	
	/* Filtra por tipo de tweets
	 * @param $type : int - indica el tipo de tweet a filtrar
	 * 
	 * */
	public function getByType($type){
		switch($type){
			case TwitterTweet::ORIGINAL:
				return $this->where('TwitterTweet.Inreplytostatusid IS NULL')->where('TwitterTweet.Inreplytouserid IS NULL');//->filterByRetweeted(false);
			break;			
			case TwitterTweet::RETWEET:
				return $this->filterByRetweetcount(array('min' => 1)); //filterByRetweeted(true);
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
	
	/* TODO: ver si se usa
	 * Obtiene cantidad de tweets aceptados y valorados como $value
	 * por dia
	 * 
	 * return (json) fecha y cantidad de tweets 
	 * */
	 // cambie el orden de los parametros, si se usa cambiarlos tambien
	/*public function getAcceptedByValue($value, $from = null, $to = null){
		
		if(!isset($from) && !isset($to)){
			
			$positive = TwitterTweetQuery::create()
				->withColumn('count(TwitterTweet.Id)', 'tweets')
				->withColumn('CAST(TwitterTweet.Createdat as DATE)', 'date')
				->filterByStatus(TwitterTweet::ACCEPTED)
				->filterByValue($value)
				->groupBy('TwitterTweet.date')
				->select(array('date','tweets'))
				->find()
				->toArray();
			
		}else{
			// ver que hacer aca
		}
		return $positiveTweets;
	}*/
	
	/* Aplica los filtros basicos requeridos para los reportes
	 * 
	 * */
	public function applyReportFilters($filters){
		
		$personal = $filters['personalized'];
		if(empty($filters['type'])) 
			$filters['type'] = 0;
		
		return $this->filterByCampaignid($filters['campaign'])
					->filterByCreatedat(array('min' => $filters['from'], 'max' => $filters['to']))
					->filterByStatus(TwitterTweet::ACCEPTED)
					->filterByText("%$personal%", Criteria::LIKE)
					->getByType($filters['type'])
					->_if(!empty($filters['gender']))
						->useTwitterUserQuery()
							->filterByGender($filters['gender'])
						->endUse()
					->_endif();
					
	}
	
	public static function getAllByValue($filters, $totalCount = false){
	 	
		$byValue = TwitterTweetQuery::create()
			->applyReportFilters($filters)
			->_if(!$totalCount)
				->withColumn('CAST(TwitterTweet.Createdat as DATE)', 'date')
				->groupBy('TwitterTweet.date')
			->_endif()
			->countByValue($filters, $totalCount)
			->find();
		
		return $byValue;
	}
	
	/* Agrupa la cantidad de tweets por valor
	 * 
	 * */
	private function countByValue($filters, $totalCount = false){
		
		$positive = TwitterTweet::POSITIVE;
		$neutral = TwitterTweet::NEUTRAL;
		$negative = TwitterTweet::NEGATIVE;
		
		return $this->_if(!empty($filters['relevance']))
						->filterByRelevance($filters['relevance'])
					->_endif()
					->_if(!empty($filters['value']))
						->filterByValue($filters['value'])
					->_endif()
					->withColumn('sum(if(TwitterTweet.Value = '. $positive .', 1, 0))', 'positive')
					->withColumn('sum(if(TwitterTweet.Value = '. $neutral .', 1, 0))', 'neutral')
					->withColumn('sum(if(TwitterTweet.Value = '. $negative .', 1, 0))', 'negative')
					->_if($totalCount)
						->select(array('positive', 'neutral', 'negative'))
					->_else()
						->select(array('date','positive', 'neutral', 'negative'))
					->_endif();

	}
	
	public static function getAllByRelevance($filters, $totalCount = false){
		
		$byRelevance = TwitterTweetQuery::create()
			->applyReportFilters($filters)
			->_if(!$totalCount)
				->withColumn('CAST(TwitterTweet.Createdat as DATE)', 'date')
				->groupBy('TwitterTweet.date')
			->_endif()
			->countByRelevance($filters, $totalCount)
			->find();
		
		return $byRelevance;
	}
	
	private function countByRelevance($filters, $totalCount = false){
		
		$relevant = TwitterTweet::RELEVANT;
		$neutrally_relevant = TwitterTweet::NEUTRALLY_RELEVANT;
		$irrelevant = TwitterTweet::IRRELEVANT;
		
		return $this->_if(!empty($filters['value']))
						->filterByValue($filters['value'])
					->_endif()
					->_if(!empty($filters['relevance']))
						->filterByRelevance($filters['relevance'])
					->_endif()
						->withColumn('sum(if(TwitterTweet.Relevance = '. $relevant .', 1, 0))', 'relevant')
						->withColumn('sum(if(TwitterTweet.Relevance = '. $neutrally_relevant .', 1, 0))', 'neutrally_relevant')
						->withColumn('sum(if(TwitterTweet.Relevance = '. $irrelevant .', 1, 0))', 'irrelevant')
					->_if($totalCount)
						->select(array('relevant', 'neutrally_relevant', 'irrelevant'))
					->_else()
						->select(array('date','relevant', 'neutrally_relevant', 'irrelevant'))
					->_endif();
	}
	
	/* Obtiene cantidad de tweets por genero
	 * 
	 * */
	public static function getAllByGender($filters){
		
		$byGender = TwitterTweetQuery::create()
			->applyReportFilters($filters)
			->_if(!empty($filters['value']))
				->filterByValue($filters['value'])
			->_endif()
			->_if(!empty($filters['relevance']))
				->filterByValue($filters['relevance'])
			->_endif()
			->countByGender($filters)
			->find()
			->toArray();

		return $byGender;
	}
	
	private function countByGender(){	
		
		return $this->_if($filters['gender'] == 'female')
						->useTwitterUserQuery()
							->withColumn('sum(if(TwitterUser.Gender = '. TwitterUser::FEMALE .', 1, 0))', 'female')
						->endUse()
						->select('female')
					->_elseif($filters['gender'] == 'male')
						->useTwitterUserQuery()
							->withColumn('sum(if(TwitterUser.Gender = '. TwitterUser::MALE .', 1, 0))', 'male')
						->endUse()
						->select('male')
					->_else()
						->useTwitterUserQuery()
							->withColumn('sum(if(TwitterUser.Gender = '. TwitterUser::FEMALE .', 1, 0))', 'female')
							->withColumn('sum(if(TwitterUser.Gender = '. TwitterUser::MALE .', 1, 0))', 'male')
						->endUse()
						->select(array('female','male'))
					->_endif();
	}
	
	/* Obtiene los tweets por valor para el reporte
	 * */
	public function getTweetsForReport($filters){
		
		if(empty($filters['type']))
			$filters['type'] = 0;
			
		$tweets = TwitterTweetQuery::create()
			->applyReportFilters($filters)
			->_if(!empty($filters['value']))
				->filterByValue($filters['value'])
			->_endif()
			->_if(!empty($filters['relevance']))
				->filterByValue($filters['relevance'])
			->_endif()
			->find();

		return $tweets;
	}
	
	/*No esta en uso*/
	public static function getTotalTweets($filters){
		$totalTweets = TwitterTweetQuery::create()
			->filterByCampaignid($filters['campaign'])
			->filterByCreatedat(array('min' => $filters['from'], 'max' => $filters['to']))
			->filterByStatus(TwitterTweet::ACCEPTED)
			->useTwitterUserQuery()
				->filterByGender($filters['gender'])
			->endUse()
			->find();
			
		return count($totalTweets);
	}
	/* Obtiene la cantidad de tweets de todas las combinaciones entre
	 * valores y relevancias
	 * */
	public static function getCombinations($filters){
		
		$tempValues = TwitterTweet::getValues();
		$tempRelevances = TwitterTweet::getRelevances();
		
		$valueFilter = $filters['value'];
		$relevanceFilter = $filters['relevance'];
		
		if(!empty($valueFilter))
			$values[$valueFilter] = $tempValues[$valueFilter];
		else
			$values = $tempValues;
		if(!empty($relevanceFilter))
			$relevances[$relevanceFilter] = $tempRelevances[$relevanceFilter];
		else
			$relevances = $tempRelevances;

		if(empty($filters['type'])) 
			$filters['type'] = 0;

		$combinations = array();
		$i = 0;
		
		foreach($values as $value => $name){
			foreach($relevances as $relevance => $relName){
				
				$tweetsAmount = TwitterTweetQuery::create()
					->applyReportFilters($filters)
					->filterByValue($value)
					->filterByRelevance($relevance)
					->count();
				
				$combinations[$i]['name'] = $name . '-' . $relName;
				$combinations[$i]['size'] = $tweetsAmount;
				
				$i++;
			}
		}
		
		return $combinations;
	}
	
	public function formatForTreemap($toFormat, $parentName){
		/*$newKeys = array('value' => 'size');
		array_combine(array_merge($toFormat, $newKeys), $toFormat);*/
		$formatted = array('name' => $parentName, 'children' => $toFormat);
		
		return json_encode($formatted);
	}

	/* Obtiene los datos para el diagrama de venn
	* 
	* @filters: filtros a aplicar a los tweets
	* @return: array(JSON) arreglo de sets y overlaps para usar en el grafico
	*/
	public static function getVennData($filters){

		// obtengo los sets por valor y relevancia sin formato
		$byValue = TwitterTweetQuery::getAllByValue($filters, true)->toArray();
		$byValue = $byValue[0];
		$valuesOrder = TwitterTweet::getTwitterConstants(array_keys($byValue));

		$byRelevance = TwitterTweetQuery::getAllByRelevance($filters, true)->toArray();
		$byRelevance = $byRelevance[0];
		$relevancesOrder = TwitterTweet::getTwitterConstants(array_keys($byRelevance));
		
		$unformattedSets = array_merge($byRelevance, $byValue);

		$vennData['sets'] = TwitterTweetQuery::formatVennSets($unformattedSets);
		$vennData['overlaps'] = TwitterTweetQuery::getVennOverlaps($valuesOrder, $relevancesOrder, $filters);

		return $vennData;

	}


	/* Formatea el arreglo de conjuntos para el diagrama de venn
	* 
	* @param $unformattedSets: arreglo de conjuntos. ej array($nombreConj => $cantElementos)
	* return: JSON {['label': $nombreConj, 'size': $cantElem]}
	*/
	public static function formatVennSets($unformattedSets){

		// formateo los sets 
		$sets = array();
		$i = 0;

		foreach ($unformattedSets as $key => $value) {
			$sets[$i]['label'] = $key;
			$sets[$i]['size'] = $value;
			$i++;
		}

		return json_encode($sets);

	}


	/* Obtiene las uniones para el diagrama de Venn
	* 
	* @param $valuesOrder: valor de las constantes VALUE en orden
	* @param $relevancesOrder: valor de las constantes RELEVANCE en orden
	* return: JSON - {['sets': [setX, setY], 'size': #{setX U setY}]}
	*/
	public static function getVennOverlaps($valuesOrder, $relevancesOrder, $filters){

		// obtengo los overlaps
		$overlaps = array();
		$i = 0;
		$offset = count($valuesOrder);
		// obtengo las intersecciones
		foreach ($valuesOrder as $keyV => $valueV) {
			foreach ($relevancesOrder as $keyR => $valueR) {
				$filters['value'] = $valueV;
				$filters['relevance'] = $valueR;
				$amount = TwitterTweetQuery::getTweetsForReport($filters)->count();
				$overlaps[$i]['sets'] = array($keyV, $keyR + $offset);
				$overlaps[$i]['size'] = $amount;
				$i++;
			}
		}

		return json_encode($overlaps);

	}
	
	public static function getUsersAmount($filters){
		
		$usersAmount = TwitterTweetQuery::create()
					->applyReportFilters($filters)
					->_if(!empty($filters['value']))
						->filterByValue($filters['value'])
					->_endif()
					->_if(!empty($filters['relevance']))
						->filterByValue($filters['relevance'])
					->_endif()
					->groupByInternaltwitteruserid()
					->count();
					
		return $usersAmount;
	}
	
	public function getPersonalTrends($filters, &$treemapInfo){
		require_once 'TwitterAnalyze.class.php';
		
		if(empty($filters['type'])) 
			$filters['type'] = 0;
		
		$timeline_bank = new timeline_bank();

		//punc that irrelevant to trends:
		$punc = TwitterTweet::getPunctuation();
		$stopwords = TwitterTweet::getStopWords();
		$last_id = 0;
		
		$personal = $filters['personalized'];
		
		//$usage = memory_get_usage();
		
		// obtengo los tweets aceptados
		$tweets = TwitterTweetQuery::create()
			->applyReportFilters($filters)
			->_if(!empty($filters['value']))
				->filterByValue($filters['value'])
			->_endif()
			->_if(!empty($filters['relevance']))
				->filterByValue($filters['relevance'])
			->_endif()
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
		return $timeline_bank->prioritize(0, $treemapInfo);
		
		//return $timeline_bank->result;
	
	}
}
