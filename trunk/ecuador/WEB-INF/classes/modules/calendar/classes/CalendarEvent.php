<?php



/**
 * Skeleton subclass for representing a row from the 'calendar_event' table.
 *
 * Eventos del Calendario
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.calendar.classes
 */
class CalendarEvent extends BaseCalendarEvent{
	const NOTPUBLISHED = 1;
	const PUBLISHED = 2;
	const ARCHIVED = 3;
	
	/**
	 * Devuelve los estados posibles de la eventos y sus codigos
	 * para la generacion de selects
	 */
	public function getStatuses() {

	$status[CalendarEvent::NOTPUBLISHED] = 'No Publicado';
	$status[CalendarEvent::PUBLISHED] = 'Publicado';
	$status[CalendarEvent::ARCHIVED] = 'Archivado';

	return $status;
	}
	
	
	/**
	 * Devuelve el nombre del estado actual en que se encuentra la noticia
	 *
	 */
	public function getStatusName() {
		$status = CalendarEvent::getStatus();
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
		return $this->getMedias(CalendarMedia::CALENDARMEDIA_IMAGE);
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
		return $this->hasMedias(CalendarMedia::CALENDARMEDIA_IMAGE);
	}	
	
	
	public function getFirstImage() {
		require_once("CalendarMediaPeer.php");
		$criteria = new Criteria();	
		$criteria->add(CalendarMediaPeer::CALENDAREVENTID,$this->getId());		
		$criteria->add(CalendarMediaPeer::MEDIATYPE,CalendarMedia::CALENDARMEDIA_IMAGE);
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
	
  /** TODO: probar que ande
  * Obtiene todos los d�as que ocupa el Evento en el A�o y Mes parametro, sabiendo que el evento por lo menos esta en un dia de ese mes
  *
  * @param int $year A�o
  * @param int $month Mes
  *	@return array d�as que ocupa el Evento en el A�o y Mes especificado
  */
  function getEventDaysOnMonth($year,$month) {
	$days = array();
	$start = CalendarEvent::getMonthStartDate($year,$month);
	$end = CalendarEvent::getMonthEndDate($year,$month);

	$monthStart = substr($start,5,2);
	$yearStart = substr($start,0,4);
	$dayStart = substr($start,8,2);
	
	$monthEnd = substr($end,5,2);
	$yearEnd = substr($end,0,4);
	$dayEnd = substr($end,8,2);
	
	//obtengo la cantidad de dias que tiene el mes
	$days_in_month = cal_days_in_month (CAL_GREGORIAN, $month, $year);

	if ($dayStart <= 9)
		$dayStart = $dayStart[0];

	if ($dayEnd <= 9)
		$dayEnd = $dayEnd[0];


	if ($yearStart < $year || $monthStart < $month) {
		$dayStart = 1;
	}

	if ($yearEnd > $year || $monthEnd > $month) {
		$dayEnd = $days_in_month;
	}

	$day = $dayStart;
	
	//return $dayStart;
	
	while ($day <= $dayEnd) {
		$days[] = $day;
		$day++;
	}

	return $days; 
  }
  
  	/**
	* Obtiene el primer dia del mes para crear el filtro
	*
	* @param int $year Año
	* @param int $month Mes
	*	@return string fecha inicio de ese mes en ese año
	*/
	function getMonthStartDate($year, $month) {
		return $year.'-'.$month.'-01 00:00:00';
	}
	
  	/**
	* Obtiene el ultimo dia del mes para crear el filtro
	*
	* @param int $year Año
	* @param int $month Mes
	*	@return string fecha fin de ese mes en ese año
	*/
	function getMonthEndDate($year, $month) {
		$daysInMonth = cal_days_in_month (CAL_GREGORIAN, $month, $year);
		return $year.'-'.$month.'-'.$daysInMonth.' 23:59:59';
	}
	
	/** Migrada de Peer
 	* Crea un Preview de una articulo.
	* Devuelve una instancia de articulo el cual no ha salvado en la base de datos.
	*
	* @param array $params Array asociativo con los atributos del objeto
	* @return boolean true si se creo correctamente, false sino
	*/
	function createPreview($params) {

			$CalendarEventObj = new CalendarEvent();
			foreach ($params as $key => $value) {
				$setMethod = "set".$key;
				if ( method_exists($CalendarEventObj,$setMethod) ) {
					if (!empty($value) || $value == "0")
						$CalendarEventObj->$setMethod($value);
					else
						$CalendarEventObj->$setMethod(null);
				}
			}

		return $CalendarEventObj;
	}
	
	/** Migrada de Peer
	* Obtiene todos los eventos anteriores al mes/año
	*
	* @param int $year Año
	* @param int $month Mes
	*	@return array Informacion sobre todos los CalendarEvents del mes
	*/
	function getEventsBeforeMonth($year, $month) {
		$date = $year.'-'.$month.'-01 00:00:00';
		$result = CalendarEvent::getEventsBeforeDate($date);
		return $result;
	}
	
	/** Migrada, eliminar
	* Obtiene todos los eventos antes de una fecha
	*
	* @param int $date fecha
	*	@return array Informacion sobre todos los Eventos antes de esa fecha
	**/

	 function getEventsBeforeDate($date) {
		$result = CalendarEventQuery::create()
			->where('CalendarEvent.StartDate < ?',$date)
			->where('CalendarEvent.EndDate >= ?',$date)
			->filterByStatus(CalendarEvent::PUBLISHED)
			->find();
			
		/*$c = new Criteria();
		$crit0 = $c->getNewCriterion(CalendarEventPeer::STARTDATE,$date,Criteria::LESS_THAN);
		$crit1 = $c->getNewCriterion(CalendarEventPeer::ENDDATE,$date,Criteria::GREATER_EQUAL);

		$crit0->addAnd($crit1);

		$c->add($crit0);
		$c->add(CalendarEventPeer::STATUS,CalendarEventPeer::PUBLISHED);

		$result = CalendarEventPeer::doSelect($c);*/
		return $result;
	 }
	 
	 /** Migrada de Peer
	* Obtiene todos los eventos entre dos fechas (comienzo y fin)
	*
	* @param int $paramStart fecha de comienzo
	* @param int $paramEnd  fecha de fin
	*	@return array Informacion sobre todos los Eventos entre esas fechas
	*/
	 function getEventsBetweenDates($paramStart,$paramEnd) {
		$result = CalendarEventQuery::create()
			->condition('c0','CalendarEvent.StartDate >= ?', $paramStart)
			->condition('c1','CalendarEvent.StartDate <= ?', $paramEnd)
			->combine(array('c0','c1'), 'and', 'c01')
			->condition('c2','CalendarEvent.EndDate <= ?', $paramEnd)
			->condition('c3','CalendarEvent.EndDate >= ?', $paramStart)
			->combine(array('c2','c3'), 'and', 'c23')
			->condition('c4','CalendarEvent.StartDate <= ?', $paramStart)
			->condition('c5','CalendarEvent.EndDate >= ?', $paramEnd)
			->combine(array('c4','c5'), 'and', 'c45')
			->combine(array('c01','c23'), 'or', 'c02')
			->where(array('c02','c45'), 'or')
			->filterByStatus(CalendarEvent::PUBLISHED)
			->find();
			
		return $result;
	 }

	/**
	* Obtiene todos los eventos del mes/año
	*
	* @param int $year Año
	* @param int $month Mes
	*	@return array Informacion sobre todos los CalendarEvents del mes
	*/
	function getEventsMonth($year, $month) {
		$daysInMonth = cal_days_in_month (CAL_GREGORIAN, $month, $year);
		$paramStart = $year.'-'.$month.'-01 00:00:00';
		$paramEnd = $year.'-'.$month.'-'.$daysInMonth.' 23:59:59';

		$result = CalendarEvent::getEventsBetweenDates($paramStart,$paramEnd);
		return $result;
	}
	
	/** Migrado de Peer
	* Suma n dias a una fecha
	*
	* @param string $date fecha
	* @param int $ndays cantidad de dias
	* @return nueva fecha
	*/

	function addDate($date,$ndays) {
		list($year,$month,$day)=explode("-",$date);

		$new = mktime(0,0,0, $month,$day,$year) + $ndays * 24 * 60 * 60;
		$newdate = date("Y-m-d",$new);

		return ($newdate);
	}
	
	/** Migrado de Peer
	* Obtiene todos los eventos de un dia
	*
	* @param int $date fecha de los eventos
	*	@return array Informacion sobre todos los CalendarEvents del dia
	*/
	function getEventsOnDay($date) {
		list($year,$month,$day) = explode("-",$date);
		$paramStart = $year.'-'.$month.'-'.$day.' 00:00:00';
		$paramEnd = $year.'-'.$month.'-'.$day.' 23:59:59';

		$result = CalendarEvent::getEventsBetweenDates($paramStart,$paramEnd);
		return $result;
	}
	
	public function getLogData(){
		return substr($this->getTitle(),0,50);
	}
}
