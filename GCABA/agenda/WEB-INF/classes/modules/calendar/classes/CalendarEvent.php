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
	 * Constructs a new CalendarEvent class, setting the class_key column to CalendarEventPeer::CLASSKEY_1.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->setClassKey(CalendarEventPeer::CLASSKEY_1);
	}
	
	/**
	 * Devuelve true si el CalendarEvent tiene asociado el eje,
	 * y false caso contrario.
	 * 
	 * @param CalendarAxis $axis
	 * @return boolean
	 */
	public function hasCalendarAxis($axis) {
//		return EventAxisQuery::create()->filterByAxisid($axis->getId())->count() > 0;
	}
	
	/**
	 * Devuelve true si el CalendarEvent tiene asociado el actor,
	 * y false caso contrario.
	 * 
	 * @param EventActor $actor
	 * @return boolean
	 */
	public function hasActor($actor) {
		return EventActorQuery::create()->filterByCalendarEvent($this)->filterByActor($actor)->count() > 0;
	}
	
	/**
	 * Devuelve true si el CalendarEvent tiene asociada la categoría,
	 * y false caso contrario.
	 * 
	 * @param Category $region
	 * @return boolean
	 */
	public function hasCategory($category) {
		return EventCategoryQuery::create()->filterByCalendarEvent($this)->filterByCategory($category)->count() > 0;
	}
	
	/**
	 * Devuelve true si el CalendarEvent tiene asociada la region,
	 * y false caso contrario.
	 * 
	 * @param Region $region
	 * @return boolean
	 */
	public function hasRegion($region) {
		return EventRegionQuery::create()->filterByCalendarEvent($this)->filterByRegion($region)->count() > 0;
	}
	
	/**
	 * Devuelve el nombre del estado actual en que se encuentra la noticia
	 * 
	 * @return string Nombre del estado del evento
	 */
	public function getStatusName() {
		$status = CalendarEventPeer::getStatus();
		return $status[$this->getStatus()];
	}

	/**
	 * Devuelve la direccion con nombre de calle y numero
	 * 
	 * @return string Nombre de la calle y numero
	 */
	public function getAddress() {
		$address = $this->getStreet() . " " . $this->getNumber();
		return $address;
	}

	/**
	 * Devuelve el id del actor que aparecera en el evento
	 * 
	 * @return integer		Id del actor del evento
	 */
	public function getActorImageId() {
		$actors = $this->getActors();
		$id = 0;
		$rank = 0;
		foreach ($actors as $actor) {
			if ($actor->hasImage()) {
				if (($actor->getRank() != 0) &&  ($actor->getRank() < $rank)) {
					$id = $actor->getId();
					$rank = $actor->getRank();
				}
			}
		}
		if (($id =! 0) && ($rank =! 0))
			return $id;
		else
			return;
	}

	/**
	 * Devuelve la imagen del actor que aparecera en el evento
	 * 
	 * @return image
	 */
	public function getActorImage() {
		$actor = ActorQuery::create()->findOneById($this->getActorImageId());
		if (!empty($actor))
			return $actor->getImge();
		else
			return;
	}







	/**
	 * Obtains the medias from the article
	 * @param integer value of the media constant
	 * @return array array of instances of CalendarMedia.
	 */
	private function getMedias($mediaType) {
		
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
		return $this->hasMedias(CalendarMediaPeer::CALENDARMEDIA_IMAGE);
	}	
	
	
	public function getFirstImage() {
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


// Constantes

	/**
	 * Devuelve array con tipos (kinds) de evento
	 *  id => Tipo de agenda
	 *
	 * @return array tipos de agenda
	 */
	public static function getEventKinds() {
		$agendaType = array(
			1 => 'AAA',
			2 => 'Otros eventos',
			3 => 'Agenda Cultural'
		);
		return $agendaType;
	}

	/**
	 * Devuelve array con tipos (kinds) de evento
	 *  id => Tipo de agenda
	 *
	 * @return array tipos de agenda
	 */
	public static function getAgendas() {
		$agendas = array(
			1 => 'Jefe de Gobierno',
			2 => 'Vicejefe de Gobierno',
			3 => 'Ministros',
			4 => 'Otros funcionarios'
		);
		return $agendas;
	}

	/**
	 * Devuelve array con estados (statuses) de evento
	 *  id => Estados posibles
	 *
	 * @return array tipos de estado de evento
	 */
	public static function getStatuses() {
		$agendas = array(
			1 => 'Propuesto',
			2 => 'Aprobado',
			3 => 'Confirmado',
			4 => 'Realizado',
			5 => 'No realizado'
		);
		return $agendas;
	}

	/**
	 * Devuelve array con posibles estados (statuses) de dia y hora de evento
	 *  id => Estados posibles
	 *
	 * @return array tipos de estado de dia y hora
	 */
	public static function getScheduleStatuses() {
		$agendas = array(
			1 => 'Confirmado fecha y hora',
			2 => 'Hora a confirmar',
			3 => 'Fecha a confirmar'
		);
		return $agendas;
	}


} // CalendarEvent
