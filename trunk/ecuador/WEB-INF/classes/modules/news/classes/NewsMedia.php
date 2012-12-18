<?php

require_once 'om/BaseNewsMedia.php';


/**
 * Skeleton subclass for representing a row from the 'news_media' table.
 *
 * Media de las noticias
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    news
 */
class NewsMedia extends BaseNewsMedia {
	
	public function getMediaTypeName() {
		
		$type = $this->getMediaType();
		
		switch ($type) {
			
			case NewsMediaPeer::NEWSMEDIA_IMAGE : return 'Imagen';
			case NewsMediaPeer::NEWSMEDIA_VIDEO : return 'Video';
			case NewsMediaPeer::NEWSMEDIA_SOUND : return 'Sonido';
			
		}
		
	}
	
	public function setDescription($v) {
		parent::setDescription(stripslashes($v));
	}

} // NewsMedia
