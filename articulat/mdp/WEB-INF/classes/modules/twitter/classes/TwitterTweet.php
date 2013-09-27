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
	/*Posibles valoraciones del tweet*/
	const POSITIVE = 1;
	const NEUTRAL = 2;
	const NEGATIVE = 3;
	/*Posibles relevancias del tweet*/
	const RELEVANT = 1;
	const NEUTRALLY_RELEVANT = 2;
	const IRRELEVANT = 3;
	
	public static function getStatuses(){
		$statuses[TwitterTweet::PARSED] = 'Parseado';
		$statuses[TwitterTweet::ACCEPTED] = 'Aceptado';
		$statuses[TwitterTweet::DISCARDED] = 'No Aceptado';
		return $statuses;
	}
	
	public static function getValues(){
		$values[TwitterTweet::POSITIVE] = 'Positivo';
		$values[TwitterTweet::NEUTRAL] = 'Neutro';
		$values[TwitterTweet::NEGATIVE] = 'Negativo';
		return $values;
	}
	
	public static function getRelevances(){
		$relevances[TwitterTweet::RELEVANT] = 'Relevante';
		$relevances[TwitterTweet::NEUTRALLY_RELEVANT] = 'Medianamente relevante';
		$relevances[TwitterTweet::IRRELEVANT] = 'Irrelevante';
		return $relevances;
	}
	
	public function createFromApiTweet($apiTweet, $campaignId, $embed) {
		
		//armo los arreglos para crear tweet y usuario
		$tweet = array(
			'Createdat' => date('Y-m-d H:i:s',$apiTweet->created_at),
			'Tweetid' => $apiTweet->id,
			'Tweetidstr' => $apiTweet->id_str,
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
			'Embed' => $embed
		);
		
		$user = array(
			'Id' => $apiTweet->user->id,
			'IdStr' => $apiTweet->user->id_str,
			'Name' => $apiTweet->user->name,
			'Screenname' => $apiTweet->user->screen_name,
			'Location' => $apiTweet->user->location,
			'Description' => $apiTweet->user->description,
			'Url' => $apiTweet->user->url,
			'isprotected' => $apiTweet->user->protected,
			'followers' => $apiTweet->user->followers_count,
			'friends' => $apiTweet->user->friends_count
		);
		
		//return $user;
		
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
	public static function addTweet($newTweet) {
		
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
	
	/* Cambia el status del tweet a ACCEPTED
	 * 
	 * return void
	 * */
	public function accept(){
		$this->setStatus(TwitterTweet::ACCEPTED);
		$this->save();
	}
	
	/* Cambia el status del tweet a DISCARDED
	 * 
	 * return void
	 * */
	public function discard(){
		$this->setStatus(TwitterTweet::DISCARDED);
		$this->save();
	}
	
	/* Cambia el status de varios tweets a ACCEPTED
	 * 
	 * @param $tweets: array de los ids de los tweets a modificar
	 * return void
	 * */
	public static function acceptMultiple($tweets){
		TwitterTweetQuery::create()->filterById($tweets, Criteria::IN)->update(array('Status' => TwitterTweet::ACCEPTED));
	}
	
	/* Cambia el status de varios tweets a DISCARDED
	 * 
	 * @param $tweets: array de los ids de los tweets a modificar
	 * return void
	 * */
	public static function discardMultiple($tweets){
		TwitterTweetQuery::create()->filterById($tweets, Criteria::IN)->update(array('Status' => TwitterTweet::DISCARDED));
	}
	
	/* Modifica un campo de varios tweets a DISCARDED
	 * 
	 * @param $field: campo a modificar
	 * @param $newValue: valor para setearle al campo
	 * @param $tweets: array[int] ids de los tweets a modificar
	 * return bool
	 * */
	public static function editMultiple($field,$newValue,$tweets){
		try{
			TwitterTweetQuery::create()->filterById($tweets, Criteria::IN)->update(array($field => $newValue));
		}catch(Exception $e){
			return false;
		}
		return true;
	}
	
}
