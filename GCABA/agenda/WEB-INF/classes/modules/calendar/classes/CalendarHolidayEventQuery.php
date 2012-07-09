<?php



/**
 * Skeleton subclass for representing a query for one of the subclasses of the 'calendar_event' table.
 *
 * Eventos del Calendario
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.calendar.classes
 */
class CalendarHolidayEventQuery extends BaseCalendarHolidayEventQuery {

	/**
	 * Constructor
	 *
	 * @return condicion por defecto al construir la instancia
	 */
	public function __construct($dbName = 'application', $modelName = 'CalendarEvent', $modelAlias = null) {
		parent::__construct($dbName, $modelName, $modelAlias);
			$this->orderByStartdate(Criteria::ASC);
	}

	/**
	 * Filtra searchString por title
	 *
	 * @param texto a buscar
	 * @return condicion de filtrado con texto
	 */
	public function searchString($filterValue) {
		return $this->filterByTitle("%$filterValue%", Criteria::LIKE);
	}

} // CalendarHolidayEventQuery
