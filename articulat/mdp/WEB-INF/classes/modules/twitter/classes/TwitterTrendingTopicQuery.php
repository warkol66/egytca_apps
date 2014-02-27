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
	
	public static function getMostTrending($cant){

		$night_start = date('H:i:s', strtotime('10:00 PM'));
		$evening_start = date('H:i:s', strtotime('8:00 PM'));
		$morning_start = date('H:i:s', strtotime('8:00 AM'));
		
		$topics = TwitterTrendingTopicQuery::create()
			->orderByCreatedat('asc')
			->groupBy('name')
			->withColumn('sum(
				case 
					when 
						Createdat >= "' . $night_start . ' and Createdat < "' . $morning_start . '" then 1 
						else 
							case
								 when
								 	Createdat >= "' . $morning_start . '" and  Createdat < "' . $evening_start . '" then 3
								 else
								 	case
								 		when
								 			Createdat >= "' . $evening_start . '" and Createdat < "' . $night_start . '" then 2
								 	end
							end
				end)', 'points')
			//->limit($cant)
			//->orderByOrder('asc')
			->find();
		return $topics;
	}
}
