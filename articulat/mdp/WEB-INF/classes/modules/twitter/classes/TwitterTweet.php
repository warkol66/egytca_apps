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
}
