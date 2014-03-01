<?php



/**
 * Skeleton subclass for performing query and update operations on the 'twitter_trendingTopic' table.
 *
 * Twitter / trendingTopics
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.twitter.classes
 */
class TwitterTrendingTopicQuery extends BaseTwitterTrendingTopicQuery{

	public static function getLatest($cant){
		
		$topics = TwitterTrendingTopicQuery::create()->orderByCreatedat('desc')->limit($cant)->orderByOrder('asc')->find();
		return $topics;
	}
	
	public static function getMostTrending($from, $to, $cant){

		$night_start = date('H:i:s', strtotime('10:00 PM'));
		$evening_start = date('H:i:s', strtotime('8:00 PM'));
		$morning_start = date('H:i:s', strtotime('8:00 AM'));
		
		$topics = TwitterTrendingTopicQuery::create()
			->filterByCreatedat(array('min' => $from, 'max' => $to))
			->groupBy('name')
			->withColumn('sum(
				case
					when (cast(Createdat as time) between "' . $morning_start . '" and "' . $evening_start . '") 
						then 3
						else
							(case
								when (cast(Createdat as time) between "' . $evening_start . '" and "' . $night_start . '")
									then 2
									else 1
							end)
				end)', 'points')
			->limit($cant)
			->orderBy('TwitterTrendingTopic.points', 'desc')
			->find();
		return $topics;
	}
}
