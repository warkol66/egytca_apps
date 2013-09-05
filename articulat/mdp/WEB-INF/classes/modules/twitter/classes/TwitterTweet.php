<?php



/**
 * Skeleton subclass for representing a row from the 'twitter_tweet' table.
 *
 * Tweet
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.twitter.classes
 */
class TwitterTweet extends BaseTwitterTweet{
	
	/*Posibles estados del tweet*/
	const PARSED = 1;
	const ACCEPTED = 2;
	const DISCARDED = 3;
	
	public function getStatuses(){
		$statuses[Self::PARSED] = 'Parseado';
		$statuses[Self::ACCEPTED] = 'Aceptado';
		$statuses[Self::DISCARDED] = 'No Aceptado';
		return $statuses;
	}
	
	public function createFromApiTweet($apiTweet, $campaignId) {
		
		//armo los arreglos para crear tweet y usuario
		$tweet = array(
			'Createdat' => $apiTweet->created_at,
			'Tweetid' => $apiTweet->id,
			'Tweetidstr' => $apiTweet->id_str,
	//		'InternalId' => srand((int)$seed),
			'Campaignid' => $campaignId,
			'Text' => $apiTweet->text,
			'Truncated' => $apiTweet->truncated,
			'Inreplytostatusid' => $apiTweet->in_reply_to_status_id,
			'Inreplytostatusidstr' => $apiTweet->in_reply_to_status_id_str,
			'Inreplytouserid' => $apiTweet->in_reply_to_user_id,
			'Inreplytouseridstr' => $apiTweet->in_reply_to_user_id_str,
			'Inreplytoscreenname' => $apiTweet->in_reply_to_screen_name,
	//		'Geo' => $apiTweet->geo,
	//		'Coordinates' => $apiTweet->coordinates,
	//		'Contributors' => $apiTweet->contributors,
			'Place' => $apiTweet->place,
			'Retweetcount' => $apiTweet->retweet_count,
			'Favoritecount' => $apiTweet->favorite_count,
			'Lang' => $apiTweet->lang,
		);
		
		$user = array(
			'Id' => $apiTweet->user->id,
			'IdStr' => $apiTweet->user->id_str,
			'Name' => $apiTweet->user->name,
			'ScreenName' => $apiTweet->user->screen_name,
			'Location' => $apiTweet->user->location,
			'Description' => $apiTweet->user->description,
			'Url' => $apiTweet->user->url,
			'isProtected' => $apiTweet->user->protected,
			'followers' => $apiTweet->user->followers_count,
			'friends' => $apiTweet->user->friends_count
		);
		
		$newTweet = TwitterTweet::addTweet($tweet);
		$newUser = TwitterUser::addUser($user);
		
		//seteo el id del usuario creador
		$newTweet->setUserId($newUser->getInternalId());
		$newTweet->save();
		
		// TODO: otras entidades
		
		return $newTweet;
	}
	
	/* Si el tweet que intentamos crear existe devuelve el existente
	 * Si no crea uno nuevo y lo devuelve
	 * 
	 * @param $newTweet: arreglo para crear el tweet fromArray()
	 * return: TwitterTweet
	 * */
	public function addTweet($newTweet) {
		
		$tweet = new TwitterTweet();
		$tweet->fromArray($newTweet);
		//me fijo si el tweet ya existe para esta campaña
		$internalId = $tweet->buildInternalId();
		$existent = TwitterTweetQuery::create()->findOneByInternalId($internalId);
		
		if(!is_object($existent)){
			$tweet->save();
			return $tweet;
		}
		//TODO: ver de actualizar datos aca
		return $existent;
	}
	
	/**
	* Genero el internalId antes de guardar el registro
	* usando el campaignId, texto y string id
	* 
	*/
	public function buildInternalId() {
		$idStr = $this->getTweetIdStr();
		
		if (empty($idStr))
			$this->setInternalid(md5($this->getCampaignid() . $this->getText()));
		else
			$this->setInternalid(md5($this->getCampaignid() . $this->getText() .  $idStr));
		
	}
	
	public function accept(){
		$this->setStatus(TwitterTweet::ACCEPTED);
		$this->save();
	}
	
	public function discard(){
		$this->setStatus(TwitterTweet::DISCARDED);
		$this->save();
	}
	
}
