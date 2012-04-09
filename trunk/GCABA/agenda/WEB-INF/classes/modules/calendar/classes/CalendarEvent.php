<?php

/**
 * Skeleton subclass for representing a row from the 'Calendar_event' table.
 *
 * Calendario de Eventos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    infocivica
 */
class CalendarEvent extends BaseCalendarEvent {
	
	/**
	 * Devuelve true si el CalendarEvent tiene asociado el eje,
	 * y false caso contrario.
	 * 
	 * @param CalendarAxis $axis
	 * @return boolean
	 */
	public function hasCalendarAxis($axis) {
		return EventAxisQuery::create()->filterByAxisid($axis->getId())->count() > 0;
	}
	
	/**
	 * Devuelve true si el CalendarEvent tiene asociado el actor,
	 * y false caso contrario.
	 * 
	 * @param EventActor $actor
	 * @return boolean
	 */
	public function hasActor($actor) {
		return EventActorQuery::create()->filterByActorid($actor->getId())->count() > 0;
	}
	
	/**
	 * Devuelve true si el CalendarEvent tiene asociada la categoría,
	 * y false caso contrario.
	 * 
	 * @param Category $region
	 * @return boolean
	 */
	public function hasCategory($category) {
		return EventCategoryQuery::create()->filterByCategoryid($category->getId())->count() > 0;
	}
	
	/**
	 * Devuelve true si el CalendarEvent tiene asociada la region,
	 * y false caso contrario.
	 * 
	 * @param Region $region
	 * @return boolean
	 */
	public function hasRegion($region) {
		return EventRegionQuery::create()->filterByRegionid($region->getId())->count() > 0;
	}
	
	/**
	 * Devuelve el nombre del estado actual en que se encuentra la noticia
	 *
	 */
	public function getStatusName() {
		$status = CalendarEventPeer::getStatus();
		return $status[$this->getStatus()];
	}

	/**
	 * Obtains the medias from the article
	 * @param integer value of the media constant
	 * @return array array of instances of CalendarMedia.
	 */
	private function getMedias($mediaType) {
		
		require_once("CalendarMediaPeer.php");
		
		$criteria = new Criteria();	

		$criteria->add(CalendarMediaPeer::MEDIATYPE,$mediaType);
		$criteria->addAscendingOrderByColumn(calendarMediaPeer::ORDER);
		
		$medias = $this->getCalendarMedias($criteria);
		
		return $medias;		
	}
	
	public function getImages() {
		require_once("CalendarMediaPeer.php");
		return $this->getMedias(CalendarMediaPeer::CALENDARMEDIA_IMAGE);
	}	
	
	
	public function hasMedias($mediaType) {
		require_once("CalendarMediaPeer.php");
		$criteria = new Criteria();	
		$criteria->add(CalendarMediaPeer::MEDIATYPE,$mediaType);
		$mediaCount = $this->countCalendarMedias($criteria);
		if ($mediaCount>0)
			return true;
		else
			return false;		
	}
	
	public function hasImages() {
		require_once("CalendarMediaPeer.php");
		return $this->hasMedias(CalendarMediaPeer::CALENDARMEDIA_IMAGE);
	}	
	
	
	public function getFirstImage() {
		require_once("CalendarMediaPeer.php");
		$criteria = new Criteria();	
		$criteria->add(CalendarMediaPeer::CALENDAREVENTID,$this->getId());		
		$criteria->add(CalendarMediaPeer::MEDIATYPE,CalendarMediaPeer::CALENDARMEDIA_IMAGE);
		$criteria->addAscendingOrderByColumn(CalendarMediaPeer::ORDER);
		$image = CalendarMediaPeer::doSelectOne($criteria);
		return $image;		
	}
	
	function setBody($v) {
		
		return parent::setBody(stripslashes($v));
	}

	/**
	 * Obtiene la cantidad de articulos aprobados que pueden ser mostrados por interfaz
	 * del articulo
	 * @return integer
	 */ 
	public function getApprovedCommentsCount() {
		
		$criteria = $this->getApprovedCommentsCriteria();
		return CalendarCommentPeer::doCount($criteria);
		
	}
	
	public function delete(PropelPDO $con = null) {
		require_once('CalendarMediaPeer.php');
		
		$medias = $this->getCalendarMedias();
		foreach ($medias as $media) {
			$media->delete();
		}
		return parent::delete();
	}
	
	/**
	 * Sobrecarga de save para impactar en la base la ultima actulizacion del articulo
	 * al guardarlos
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 */
	public function save(PropelPDO $con = null) {
		
		//$this->setLastUpdate(date('Y-m-d h:i:s'));
		parent::save($con);
		
	}
	
  /**
  * Obtiene todos los días que ocupa el Evento en el Año y Mes parámetro, sabiendo que el evento por lo menos esta en un día de ese mes
  *
  * @param int $year Año
  * @param int $month Mes
  * @return array días que ocupa el Evento en el Año y Mes especificado
  */
  function getEventDaysOnMonth($year,$month) {
	$days = array();
	$start = CalendarEvent::getStartDate();
	$end = CalendarEvent::getEndDate();

	$monthStart = substr($start,5,2);
	$yearStart = substr($start,0,4);
	$dayStart = substr($start,8,2);
	$monthEnd = substr($end,5,2);
	$yearEnd = substr($end,0,4);
	$dayEnd = substr($end,8,2);
	
	//obtengo la cantidad de dias que tiene el mes
	$days_in_month = cal_days_in_month (CAL_GREGORIAN, $month, $year);

	if ($dayStart <= 9)
		$dayStart = $dayStart[1];

	if ($dayEnd <= 9)
		$dayEnd = $dayEnd[1];


	if ($yearStart < $year || $monthStart < $month) {
		$dayStart = 1;
	}

	if ($yearEnd > $year || $monthEnd > $month) {
		$dayEnd = $days_in_month;
	}

	$day = $dayStart;
	
	while ($day <= $dayEnd) {
		$days[] = $day;
		$day++;
	}

	return $days; 
  }

} // CalendarEvent
