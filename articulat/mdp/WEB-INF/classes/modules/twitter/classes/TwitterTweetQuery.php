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
			return $this->filterByValue(array('min' => TwitterTweet::VERY_POSITIVE))->filterByRelevance(array('min' => TwitterTweet::VERY_RELEVANT));
		else
			return $this->filterByValue(array('max' => 0))->filterByRelevance(array('max' => 0));
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
	
	/* Obtiene cantidad de tweets aceptados y valorados como positivos
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
			//$positiveTweets['date'] = 'tweets';
			foreach($positive as $pos){
				$positiveTweets[$i]['date'] = $pos['date'];
				$positiveTweets[$i]['tweets'] = $pos['tweets'];
				$i++;
			}
			
		}else{
			
		}
		return $positiveTweets;
	}
}
