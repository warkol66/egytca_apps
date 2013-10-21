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
		return TwitterTweetQuery::create()->filterByCampaignid($campaigns)->find();
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
	
	public function getAllByValue($campaign, $from, $to, $value = null, $type){
			
		$positive = TwitterTweet::POSITIVE;
		$neutral = TwitterTweet::NEUTRAL;
		$negative = TwitterTweet::NEGATIVE;
		
		switch($value){
			case $positive:
				$byValue = TwitterTweetQuery::create()
					->withColumn('CAST(TwitterTweet.Createdat as DATE)', 'date')
					->withColumn('sum(if(TwitterTweet.Value = '. $positive .', 1, 0))', 'positive')
					->filterByCampaignid($campaign)
					->filterByCreatedat(array('min' => $from, 'max' => $to))
					->filterByStatus(TwitterTweet::ACCEPTED)
					->getByType($type)
					->groupBy('TwitterTweet.date')
					->select(array('date','positive'))
					->find();
			break;
			case $neutral:
				$byValue = TwitterTweetQuery::create()
					->withColumn('CAST(TwitterTweet.Createdat as DATE)', 'date')
					->withColumn('sum(if(TwitterTweet.Value = '. $neutral .', 1, 0))', 'neutral')
					->filterByCampaignid($campaign)
					->filterByCreatedat(array('min' => $from, 'max' => $to))
					->filterByStatus(TwitterTweet::ACCEPTED)
					->getByType($type)
					->groupBy('TwitterTweet.date')
					->select(array('date','neutral'))
					->find();
			break;
			case $negative:
				$byValue = TwitterTweetQuery::create()
					->withColumn('CAST(TwitterTweet.Createdat as DATE)', 'date')
					->withColumn('sum(if(TwitterTweet.Value = '. $negative .', 1, 0))', 'negative')
					->filterByCampaignid($campaign)
					->filterByCreatedat(array('min' => $from, 'max' => $to))
					->filterByStatus(TwitterTweet::ACCEPTED)
					->getByType($type)
					->groupBy('TwitterTweet.date')
					->select(array('date','negative'))
					->find();
			break;
			default:
				$byValue = TwitterTweetQuery::create()
					->withColumn('CAST(TwitterTweet.Createdat as DATE)', 'date')
					->withColumn('sum(if(TwitterTweet.Value = '. TwitterTweet::POSITIVE .', 1, 0))', 'positive')
					->withColumn('sum(if(TwitterTweet.Value = '. TwitterTweet::NEUTRAL .', 1, 0))', 'neutral')
					->withColumn('sum(if(TwitterTweet.Value = '. TwitterTweet::NEGATIVE .', 1, 0))', 'negative')
					->filterByCampaignid($campaign)
					->filterByCreatedat(array('min' => $from, 'max' => $to))
					->filterByStatus(TwitterTweet::ACCEPTED)
					->getByType($type)
					->groupBy('TwitterTweet.date')
					->select(array('date','positive', 'neutral', 'negative'))
					->find();
			break;
		}
		
		return $byValue;
	}
	
	public function getAllByRelevance($campaign, $from, $to, $relevance = null, $type){
		
		//TODO: agregar chequeo de si las fechas tienen 24hs de diferencia
		$relevant = TwitterTweet::RELEVANT;
		$neutrally_relevant = TwitterTweet::NEUTRALLY_RELEVANT;
		$irrelevant = TwitterTweet::IRRELEVANT;
			
		switch($relevance){
			case $relevant:
				$byRelevance = TwitterTweetQuery::create()
					->withColumn('CAST(TwitterTweet.Createdat as DATE)', 'date')
					->withColumn('sum(if(TwitterTweet.Relevance = '. $relevant .', 1, 0))', 'relevant')
					->filterByCampaignid($campaign)
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
}
