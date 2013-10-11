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
	
	public function getTopUsers($from = null, $to = null, $top = 5){
			
		if(!isset($from) && !isset($to)){
			
			$tops = TwitterTweetQuery::create()
				->withColumn('count(TwitterTweet.Id)', 'tweets')
				->filterByStatus(TwitterTweet::ACCEPTED)
				->groupBy('TwitterTweet.Twitteruserid')
				->orderBy('TwitterTweet.tweets', 'desc')
				->limit($top)
				->find();
			$users = array();
			$i = 0;
			foreach($tops as $top){
				$users[$i]['user'] = $top->getTwitterUser();
				$users[$i]['tweets'] = $top->getTweets();
				$i++;
			}
		}else{
			
		}
		return $users;
	}
}
