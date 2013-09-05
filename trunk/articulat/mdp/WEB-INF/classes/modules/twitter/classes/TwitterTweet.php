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
	
		$seed = md5(date("Ymd"));
		
		$tweet = new TwitterTweet();
		$tweet->fromArray(array(
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
		));
		

		$user = array(
			'Id' => $apiTweet->user->id,
			'IdStr' => $apiTweet->user->id_str,
			'Name' => $apiTweet->user->name,
			'ScreenName' => $apiTweet->user->screen_name,
			'Location' => $apiTweet->user->location,
			'Description' => $apiTweet->user->description,
			'Url' => $apiTweet->user->url,
			'isProtected' => $apiTweet->user->protected
		);
		$tweet->addUser($user);
		
		// TODO: otras entidades
		
		$tweet->save();
		
		return $tweet;
	}
	
	public function addUser($newUser) {
		//me fijo si el usuario ya existe
		$existent = TwitterUserQuery::create()->findOneByIdStr($newUser['IdStr']);
		
		if(!is_object($existent)){
			$user = new TwitterUser();
			$user->fromArray($newUser);
			$user->save();
		}
	}
}
