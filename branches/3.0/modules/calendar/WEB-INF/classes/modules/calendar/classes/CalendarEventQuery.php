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
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof CalendarEventQuery) {
			return $criteria;
		}
		$query = new self('application', 'CalendarEvent', $modelAlias);
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

} // CalendarEventQuery
