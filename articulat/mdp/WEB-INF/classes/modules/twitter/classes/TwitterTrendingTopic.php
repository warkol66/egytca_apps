<?php



/**
 * Skeleton subclass for representing a row from the 'twitter_trendingTopic' table.
 *
 * Twitter / trendingTopics
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.twitter.classes
 */
class TwitterTrendingTopic extends BaseTwitterTrendingTopic{
	
	public function createFromApiTT($apiTT, $woeid, $order, $date) {
		
		//armo el arreglo
		$newTT = array(
			'Createdat' => $date,
			'Woeid' => $woeid,
			'Order' => $order,
			'Name' => $apiTT->name
		);
		
		$tt = new TwitterTrendingTopic();
		$tt->fromArray($newTT);
		$tt->save();
		
		return $tt;
	}
	
	public function getLatest($cant){
		
		$topics = TwitterTrendingTopicQuery::create()->orderByCreatedat('asc')->limit($cant)->orderByOrder('asc')->find();
		return $topics;
	}
}
