<?php



/**
 * Skeleton subclass for representing a row from the 'twitter_log' table.
 *
 * logs de cron de twitter
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.twitter.classes
 */
class TwitterLog extends BaseTwitterLog{
	
	public static function logTweetSearch($tweetsCount, $ttsCount, $campaignId, $message){
		$log = new TwitterLog();
		$log->setTweetscount($tweetsCount);
		$log->setTrendingTopicscount($ttsCount);
		$log->setCampaignid($campaignId);
		$log->setMessage($message);
		$log->save();
	}
}
