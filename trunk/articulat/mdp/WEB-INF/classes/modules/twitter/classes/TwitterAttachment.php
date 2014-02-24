<?php



/**
 * Skeleton subclass for representing a row from the 'twitter_attachment' table.
 *
 * Twitter / Attachments
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.twitter.classes
 */
class TwitterAttachment extends BaseTwitterAttachment{

	public static function createAttachmentArray($medias){

		$attachments = array();
		foreach($medias as $media){
			$attachments[] = $media->media_url;
		}

		return $attachments;
	}

	public static function addAttachments($attachments, $tweetId){

		foreach($attachments as $attachment){
			$newAtt = new TwitterAttachment();
			$newAtt
				->setTweetid($tweetId)
				->setUrl($attachment)
				->save();
		}
	}

	/**
	 * @return directory for attachment's files
	 */
	function getDataDir() {
		$dirCant = 1000; // esto se saca del config
		$squaredDirCant = $dirCant * $dirCant;
		
		preg_match("/^(\d+)-\w+$/", $this->getName(), $matches);
		$id = $matches[1];
		
		$filesDir = realpath(TwitterTweet::ATTACHMENTS_PATH);
		$firstRamification = floor($id / $squaredDirCant);
		$secondRamification = floor(($id - $firstRamification * $squaredDirCant) / $dirCant);
		
		return "$filesDir/$firstRamification/$secondRamification";
	}
	
	/**
	 * 
	 * @return string absolute path to resource
	 */
	function getRealpath() {
		$filename = $this->getName();
		return !empty($filename) ? $this->getDataDir()."/$filename" : false;
	}
}
