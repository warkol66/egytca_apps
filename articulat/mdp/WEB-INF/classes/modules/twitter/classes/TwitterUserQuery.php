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
	
	/**
	 * Agrega filtros por nombre, apellido, institucion o sobrenombre
	 *
	 * @param   type string $filterValue texto a buscar
	 * @return condicion de filtrado por texto a buscar
	 */
	public function searchString($filterValue) {
		return $this->filterByName("%$filterValue%", Criteria::LIKE)
				->_or()
					->filterByScreenname("%$filterValue%", Criteria::LIKE)
				->_or()
					->filterByDescription("%$filterValue%", Criteria::LIKE)
				->_or()
					->filterByTwitteruseridstr("%$filterValue%", Criteria::LIKE);
	}
	
	public function brokenUser(){
		return $this->filterByScreenname(null);
	}

	/* Obtiene los usuarios con mas tweets
	 * 
	 * */
	public function getTopUsers($filters, $count = 10){
		
		if(empty($filters['value'])) 
			$filters['value'] = array(0,TwitterTweet::POSITIVE,TwitterTweet::NEUTRAL,TwitterTweet::NEGATIVE);
		if(empty($filters['relevance'])) 
			$filters['relevance'] = array(0,TwitterTweet::RELEVANT,TwitterTweet::NEUTRALLY_RELEVANT,TwitterTweet::IRRELEVANT);
		if(empty($filters['type']))
			$filters['type'] = 0;
		$personal = $filters['personalized'];
			
		$tops = TwitterTweetQuery::create()
			->withColumn('count(TwitterTweet.Id)', 'tweets')
			->filterByCampaignid($filters['campaign'])
			->filterByValue($filters['value'])
			->filterByRelevance($filters['relevance'])
			->getByType($filters['type'])
			->filterByStatus(TwitterTweet::ACCEPTED)
			->filterByText("%$personal%", Criteria::LIKE)
			->filterByCreatedat(array('min' => $filters['from'],'max' => $filters['to']))
			->groupByInternaltwitteruserid()
//			->groupBy('TwitterTweet.Internaltwitteruserid')
			->orderBy('TwitterTweet.tweets', 'desc')
			->limit($count)
			->find();

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
	public function getInfluentialUsers($filters, $count = 10){
		if(empty($filters['value'])) 
			$filters['value'] = array(0,TwitterTweet::POSITIVE,TwitterTweet::NEUTRAL,TwitterTweet::NEGATIVE);
		if(empty($filters['relevance'])) 
			$filters['relevance'] = array(0,TwitterTweet::RELEVANT,TwitterTweet::NEUTRALLY_RELEVANT,TwitterTweet::IRRELEVANT);
		if(empty($filters['type'])) 
			$filters['type'] = 0;
		$personal = $filters['personalized'];
		
		$influential = TwitterUserQuery::create()
			->filterByInfluence(TwitterUser::NEUTRAL)
			->orderByInfluence(Criteria::DESC)
			->useTwitterTweetQuery()
				->groupByInternaltwitteruserid()
				->filterByStatus(TwitterTweet::ACCEPTED)
				->filterByText("%$personal%", Criteria::LIKE)
				->filterByCampaignid($filters['campaign'])
				->filterByValue($filters['value'])
				->filterByRelevance($filters['relevance'])
				->getByType($filters['type'])
				->filterByCreatedat(array('min' => $filters['from'],'max' => $filters['to']))
			->endUse()
			->limit($count)
			->find();
			
		return $influential;
	}
	
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
