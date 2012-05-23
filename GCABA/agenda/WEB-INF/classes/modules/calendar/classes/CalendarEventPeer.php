<?php

/**
 * Class CalendarEventPeer
 *
 * @package CalendarEvent
 */
class CalendarEventPeer extends BaseCalendarEventPeer {

	private $orderById = false;
	private $orderByDate = false;
	private $orderByCreationDate = false;
	private $orderByUpdateDate = false;
	private $archiveMode = false;
	private $publishedMode = false;
	private $fromDate;
	private $toDate;
	private $category;
	private $searchString;
	private $moduleConfig;

	const NOTPUBLISHED = 1;
	const PUBLISHED = 2;
	const ARCHIVED = 3;

	const AGENDA_JEFE_GOBIERNO = 1;
	const AGENDA_MINISTROS = 2;
	const AGENDA_OTROS_FUNCIONARIOS = 3;
	
	/**
	 * @return array AgendaTypeKey => description
	 */
	public function getAgendas() {
		$agendas = array();
		$agendas[CalendarEventPeer::AGENDA_JEFE_GOBIERNO] = 'Jefe de Gobierno';
		$agendas[CalendarEventPeer::AGENDA_MINISTROS] = 'Ministros';
		$agendas[CalendarEventPeer::AGENDA_OTROS_FUNCIONARIOS] = 'Otros funcionarios';
		return $agendas;
	}

	/**
	 * Especifica una cadena de busqueda. Cada palabra de la cadena sera extraida y buscada en
	 * titulos, descripcion, copete, etc.
	 * @param string cadena de busqueda.
	 */
	public function setSearchString($string) {
		$this->searchString = $string;
	}

	/**
	 * Especifica una fecha desde para una busqueda personalizada.
	 *
	 * @param $fromDate string YYYY-MM-DD
	 */
	public function setFromDate($fromDate) {

		$this->fromDate = $fromDate;

	}

	/**
	 * Especifica una fecha hasta para una busqueda personalizada.
	 *
	 * @param $toDate string YYYY-MM-DD
	 */
	public function setToDate($toDate) {

		$this->toDate = $toDate;

	}

	/**
	 * Devuelve los estados posibles de la eventos y sus codigos
	 * para la generacion de selects
	 */
	public function getStatus() {

	$status[CalendarEventPeer::NOTPUBLISHED] = 'No Publicado';
	$status[CalendarEventPeer::PUBLISHED] = 'Publicado';

	return $status;
	}

	/**
	 * Aplica ordenamiento por fecha a las consultas
	 */
	public function setOrderByDate() {

		$this->orderByDate = true;

	}

	/**
	 * Aplica ordenamiento por fecha a las consultas
	 */
	public function setOrderByCreationDate() {

		$this->orderByDate = true;

	}

	/**
	 * Aplica ordenamiento por Id
	 */
	public function setOrderById() {

		$this->orderById = true;

	}

	/**
	 * Aplica ordenamiento por fecha de actualizacion a las consultas
	 */
	public function setOrderByUpdateDate() {

		$this->orderByUpdateDate = true;

	}

	public function setArchiveMode() {

		$this->archiveMode = true;
	 // $this->archiveAndpublishedMode = false;

	}

	public function setPublishedMode() {

	$this->publishedMode = true;
	//$this->archiveAndpublishedMode = false;

	}

	public function setArchiveAndPublishedMode() {

		$this->archiveAndpublishedMode = true;
		/*$this->publishedMode = false;
		$this->archiveMode = false;*/

	}

	public function setCategory($category) {

	$this->category = $category;

	}

	public function setRegion($region) {

	$this->region = $region;

	}

	private function getModuleConfig() {

		$this->moduleConfig = Common::getModuleConfiguration('Calendar');

	}

	/**
	 * Crea una Criteria a partir de las condiciones de filtro ingresadas al peer.
	 * @return Criteria instancia de criteria
	 */
	private function getCriteria() {
	$criteria = new Criteria();
	$date = date('Y-m-d');

	$criteria->setIgnoreCase(true);

	$criteria->add(CalendarEventPeer::CLASS_KEY,1);

	if ($this->orderById)
		$criteria->addDescendingOrderByColumn(CalendarEventPeer::ID);

	if ($this->orderByDate)
		$criteria->addDescendingOrderByColumn(CalendarEventPeer::CREATIONDATE);

	if ($this->orderByCreationDate)
		$criteria->addDescendingOrderByColumn(CalendarEventPeer::CREATIONDATE);

	if ($this->archiveMode)
		$criteria->add(CalendarEventPeer::ENDDATE,$date,Criteria::LESS_THAN);

	if ($this->publishedMode) {
		$criterion = $criteria->getNewCriterion(CalendarEventPeer::STATUS,CalendarEventPeer::PUBLISHED);
		$criterion->addAnd($criteria->getNewCriterion(CalendarEventPeer::ENDDATE,$date,Criteria::GREATER_EQUAL));
		$criteria->add($criterion);
	}

	if (!empty($this->archiveAndpublishedMode))
	 $criteria->add(CalendarEventPeer::STATUS, CalendarEventPeer::PUBLISHED);

	if (!empty($this->fromDate) && ! empty($this->toDate)) {
		$criterion = $criteria->getNewCriterion(CalendarEventPeer::CREATIONDATE, $this->fromDate, Criteria::GREATER_EQUAL);
		$criterion->addAnd($criteria->getNewCriterion(CalendarEventPeer::CREATIONDATE, $this->toDate, Criteria::LESS_EQUAL));
		$criteria->add($criterion);
	}
	else {

		if (!empty($this->fromDate))
			$criteria->add(CalendarEventPeer::CREATIONDATE, $this->fromDate, Criteria::GREATER_EQUAL);

		if (!empty($this->toDate))
			$criteria->add(CalendarEventPeer::CREATIONDATE,$this->toDate, Criteria::LESS_EQUAL);
	}

	if (!empty($this->category)) {
		$category = $this->category;
		$criteria->add(CalendarEventPeer::CATEGORYID,$category->getId());
	}

	if (!empty($this->region)) {
		$region = $this->region;
		$criteria->add(CalendarEventPeer::REGIONID,$region->getId());
	}

	if (!empty($this->searchString)) {
		//separamos por palabras
		$words = explode(' ',$this->searchString);

		foreach ($words as $word) {

			$sql = "( ".CalendarEventPeer::TITLE." like '%".$word."%' )";
			if (!isset($criterionTitle))
				$criterionTitle = $criteria->getNewCriterion(CalendarEventPeer::TITLE,$sql,Criteria::CUSTOM);
			else
				$criterionTitle->addOr($criteria->getNewCriterion(CalendarEventPeer::TITLE,$sql,Criteria::CUSTOM));

			$sql = "( ".CalendarEventPeer::BODY." like '%".$word."%' )";
			if (!isset($criterionBody))
				$criterionBody = $criteria->getNewCriterion(CalendarEventPeer::BODY,$sql,Criteria::CUSTOM);
			else
				$criterionBody->addOr($criteria->getNewCriterion(CalendarEventPeer::BODY,$sql,Criteria::CUSTOM));

			$sql = "( ".CalendarEventPeer::SUMMARY." like '%".$word."%' )";
			if (!isset($criterionSummary))
				$criterionSummary = $criteria->getNewCriterion(CalendarEventPeer::SUMMARY,$sql,Criteria::CUSTOM);
			else
				$criterionSummary->addOr($criteria->getNewCriterion(CalendarEventPeer::SUMMARY,$sql,Criteria::CUSTOM));

		}

		$criterionTitle->addOr($criterionBody);
		$criterionTitle->addOr($criterionSummary);
		$criteria->add($criterionTitle);

	}

	return $criteria;

	}

	/**
	* Obtiene la cantidad de filas por pagina por defecto en los listado paginados.
	*
	* @return int Cantidad de filas por pagina
	*/
	function getRowsPerPage() {
		if (!isset($this->moduleConfig["rowsPerPage"]))
			$rowsPerPage = Common::getRowsPerPage();
		else
			$rowsPerPage = $this->moduleConfig["rowsPerPage"];
		return $rowsPerPage;
	}

	/**
	* Crea un evento nueva.
	*
	* @param array $params Array asociativo con los atributos del objeto
	* @return boolean true si se creo correctamente, false sino
	*/
	function create($params) {
		try {
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

			// Regla de negocio, cuando se crea una evento, se pasa a no publicada.
			$CalendarEventObj->setStatus(CalendarEventPeer::NOTPUBLISHED);

			$CalendarEventObj->save();
			return true;
		} catch (Exception $exp) {
			return false;
		}
	}

	/**
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

	/**
	* Actualiza la informacion de un evento.
	*
	* @param array $params Array asociativo con los atributos del objeto
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($params) {
		try {
			$CalendarEventObj = CalendarEventPeer::retrieveByPK($params["id"]);
			if (empty($CalendarEventObj))
				throw new Exception();
			foreach ($params as $key => $value) {
				$setMethod = "set".$key;
				if ( method_exists($CalendarEventObj,$setMethod) ) {
					if (!empty($value) || $value == "0")
						$CalendarEventObj->$setMethod($value);
					else
						$CalendarEventObj->$setMethod(null);
				}
			}
			$CalendarEventObj->save();
			return true;
		} catch (Exception $exp) {
			return false;
		}
	}

	/**
	* Elimina un evento a partir de los valores de la clave.
	*
	* @param int $id id del CalendarEvent
	*	@return boolean true si se elimino correctamente el CalendarEvent, false sino
	*/
	function delete($id) {
		$CalendarEventObj = CalendarEventPeer::retrieveByPK($id);
		$CalendarEventObj->delete();
		return true;
	}

	/**
	* Obtiene la informacion de un evento.
	*
	* @param int $id id del CalendarEvent
	* @return array Informacion del CalendarEvent
	*/
	function get($id) {
		$CalendarEventObj = CalendarEventPeer::retrieveByPK($id);
		return $CalendarEventObj;
	}

	/**
	* Obtiene todos los eventos.
	*
	*	@return array Informacion sobre todos los CalendarEvents
	*/
	function getAll() {
		$cond = new Criteria();
		$alls = CalendarEventPeer::doSelect($cond);
		return $alls;
	}

	/**
	* Obtiene todos los eventos paginados.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los CalendarEvents
	*/
	function getAllPaginated($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = 	CalendarEventPeer::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = new Criteria();
		$pager = new PropelPager($cond,"CalendarEventPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

	/**
	* Obtiene todos los eventos paginados con las opciones de filtro asignadas al peer.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los CalendarEvents
	*/
	function getAllPaginatedFiltered($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = 	CalendarEventPeer::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = $this->getCriteria();
		$pager = new PropelPager($cond,"CalendarEventPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

	/**
	* Obtiene todos los eventos entre dos fechas (comienzo y fin)
	*
	* @param int $paramStart fecha de comienzo
	* @param int $paramEnd  fecha de fin
	*	@return array Informacion sobre todos los Eventos entre esas fechas
	*/
	 function getEventsBetweenDates($paramStart,$paramEnd) {
		$c = new Criteria();

		$crit0 = $c->getNewCriterion(CalendarEventPeer::STARTDATE,$paramStart,Criteria::GREATER_EQUAL);
		$crit1 = $c->getNewCriterion(CalendarEventPeer::STARTDATE,$paramEnd,Criteria::LESS_EQUAL);
		$crit0->addAnd($crit1);
		$crit2 = $c->getNewCriterion(CalendarEventPeer::ENDDATE,$paramEnd,Criteria::LESS_EQUAL);
		$crit3 = $c->getNewCriterion(CalendarEventPeer::ENDDATE,$paramStart,Criteria::GREATER_EQUAL);
		$crit2->addAnd($crit3);
		$crit0->addOr($crit2);
		$crit4 = $c->getNewCriterion(CalendarEventPeer::STARTDATE,$paramStart,Criteria::LESS_EQUAL);
		$crit5 = $c->getNewCriterion(CalendarEventPeer::ENDDATE,$paramEnd,Criteria::GREATER_EQUAL);
		$crit4->addAnd($crit5);
		$crit0->addOr($crit4);
		$c->add($crit0);

		$c->add(CalendarEventPeer::STATUS,CalendarEventPeer::PUBLISHED);

		$result = CalendarEventPeer::doSelect($c);
		return $result;
	 }

	/**
	* Obtiene todos los eventos del mes/a�o
	*
	* @param int $year A�o
	* @param int $month Mes
	*	@return array Informacion sobre todos los CalendarEvents del mes
	*/
	function getEventsMonth($year, $month) {
		$daysInMonth = cal_days_in_month (CAL_GREGORIAN, $month, $year);
		$paramStart = $year.'-'.$month.'-01 00:00:00';
		$paramEnd = $year.'-'.$month.'-'.$daysInMonth.' 23:59:59';

		$result = CalendarEventPeer::getEventsBetweenDates($paramStart,$paramEnd);
		return $result;
	}

	/**
	* Obtiene todos los eventos antes de una fecha
	*
	* @param int $date fecha
	*	@return array Informacion sobre todos los Eventos antes de esa fecha
	*/

	 function getEventsBeforeDate($date) {
		$c = new Criteria();
		$crit0 = $c->getNewCriterion(CalendarEventPeer::STARTDATE,$date,Criteria::LESS_THAN);
		$crit1 = $c->getNewCriterion(CalendarEventPeer::ENDDATE,$date,Criteria::GREATER_EQUAL);

		$crit0->addAnd($crit1);

		$c->add($crit0);
		$c->add(CalendarEventPeer::STATUS,CalendarEventPeer::PUBLISHED);

		$result = CalendarEventPeer::doSelect($c);
		return $result;
	 }

 /**
	* Obtiene todos los eventos anteriores al mes/a�o
	*
	* @param int $year A�o
	* @param int $month Mes
	*	@return array Informacion sobre todos los CalendarEvents del mes
	*/
	function getEventsBeforeMonth($year, $month) {
		$date = $year.'-'.$month.'-01 00:00:00';
		$result = CalendarEventPeer::getEventsBeforeDate($date);
		return $result;
	}

	/**
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

	/**
	* Obtiene todos los eventos de un dia
	*
	* @param int $date fecha de los eventos
	*	@return array Informacion sobre todos los CalendarEvents del dia
	*/
	function getEventsOnDay($date) {
		list($year,$month,$day) = explode("-",$date);
		$paramStart = $year.'-'.$month.'-'.$day.' 00:00:00';
		$paramEnd = $year.'-'.$month.'-'.$day.' 23:59:59';

		$result = CalendarEventPeer::getEventsBetweenDates($paramStart,$paramEnd);
		return $result;
	}

}