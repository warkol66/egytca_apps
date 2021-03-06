<?php

/**
 * Skeleton subclass for representing a row from the 'Calendar_media' table.
 *
 * Media del Calendario
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    infocivica
 */
class CalendarMedia extends BaseCalendarMedia {
	
	public function getMediaTypeName() {
		
		$type = $this->getMediaType();
		
		switch ($type) {
			
			case CalendarMediaPeer::CalendarMEDIA_IMAGE : return 'Imagen';
			case CalendarMediaPeer::CalendarMEDIA_VIDEO : return 'Video';
			case CalendarMediaPeer::CalendarMEDIA_SOUND : return 'Sonido';
			
		}
		
	}
	
	public function setDescription($v) {
		parent::setDescription(stripslashes($v));
	}

} // CalendarMedia
