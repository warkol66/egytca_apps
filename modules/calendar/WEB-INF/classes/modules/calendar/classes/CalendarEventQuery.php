<?php


/**
 * Skeleton subclass for performing query and update operations on the 'calendar_event' table.
 *
 * Eventos del Calendario
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.calendar.classes
 */
class CalendarEventQuery extends BaseCalendarEventQuery {

	/**
	 * Returns a new CalendarEventQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    CalendarEventQuery
	 */
	/*public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof CalendarEventQuery) {
			return $criteria;
		}
		$query = new self('application', 'CalendarEvent', $modelAlias);
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}*/
	
	/** Migrada de Peer
	* Obtiene todos los eventos anteriores al mes/año
	*
	* @param int $year Año
	* @param int $month Mes
	*	@return array Informacion sobre todos los CalendarEvents del mes
	*/
	function getEventsBeforeMonth($year, $month) {
		$date = $year.'-'.$month.'-01 00:00:00';
		$result = CalendarEventQuery::getEventsBeforeDate($date);
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
			->filterByStartDate($date,Criteria::LESS_THAN)
			->filterByEndDate($date,Criteria::GREATER_EQUAL)
			->filterByStatus($date,CalendarEvent::PUBLISHED)
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

		$result = CalendarEventPeer::getEventsBetweenDates($paramStart,$paramEnd);
		return $result;
	}

} // CalendarEventQuery
