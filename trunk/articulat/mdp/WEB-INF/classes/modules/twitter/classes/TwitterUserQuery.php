<?php



/**
 * Skeleton subclass for performing query and update operations on the 'twitter_user' table.
 *
 * Twitter / Users
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.twitter.classes
 */
class TwitterUserQuery extends BaseTwitterUserQuery{
	
	/* Obtiene los usuarios con mas tweets
	 * 
	 * */
	public function getTopUsers($campaign,$from = null, $to = null, $count = 5){
			
		if(!isset($from) && !isset($to)){
			
			$tops = TwitterTweetQuery::create()
				->withColumn('count(TwitterTweet.Id)', 'tweets')
				->filterByCampaignid($campaign)
				->filterByStatus(TwitterTweet::ACCEPTED)
				->groupBy('TwitterTweet.Internaltwitteruserid')
				->orderBy('TwitterTweet.tweets', 'desc')
				->limit($count)
				->find();
		}else{
			$tops = TwitterTweetQuery::create()
				->withColumn('count(TwitterTweet.Id)', 'tweets')
				->filterByCampaignid($campaign)
				->filterByStatus(TwitterTweet::ACCEPTED)
				->filterByCreatedat(array('min' => $from,'max' => $to))
				->groupBy('TwitterTweet.Internaltwitteruserid')
				->orderBy('TwitterTweet.tweets', 'desc')
				->limit($count)
				->find();
		}
		$users = array();
		$i = 0;
		foreach($tops as $top){
			$users[$i]['user'] = $top->getTwitterUser();
			$users[$i]['tweets'] = $top->getTweets();
			$i++;
		}
		return $users;
	}
	
	/* Obtiene los usuarios mas influyentes
	 * 
	 * */
	/*public function getInfluentialUsers($from = null, $to = null, $count = 5){
			
		if(!isset($from) && !isset($to)){
			$tops = TwitterTweetQuery::create()
				->withColumn('count(TwitterTweet.Id)', 'tweets')
				->filterByStatus(TwitterTweet::ACCEPTED)
				->groupBy('TwitterTweet.Internaltwitteruserid')
				->orderBy('TwitterTweet.tweets', 'desc')
				->limit($count)
				->find();
		}else{
			$tops = TwitterTweetQuery::create()
				->withColumn('count(TwitterTweet.Id)', 'tweets')
				->filterByStatus(TwitterTweet::ACCEPTED)
				->groupBy('TwitterTweet.Internaltwitteruserid')
				->orderBy('TwitterTweet.tweets', 'desc')
				->limit($count)
				->find();
		}
		$users = array();
		$i = 0;
		foreach($tops as $top){
			$users[$i]['user'] = $top->getTwitterUser();
			$users[$i]['tweets'] = $top->getTweets();
			$i++;
		}
		return $users;
	}*/
	
	/**
	* Obtiene todos los usuarios de twitter disponibles para el actor
	*
	* @return array usuarios posibles a elegir
	*/
	public function getCandidateActors($candidates){
		if($candidates){
			//busco los usuarios de twitter que estan asociados a algun actor
			$associatedUsers = ActorQuery::create()->where('Internaltwitteruserid IS NOT NULL')->select('Actor.Internaltwitteruserid')->find();
			
			return $this->filterById($associatedUsers, Criteria::NOT_IN);
		}
	}
}
