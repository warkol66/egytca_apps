<?php



/**
 * Skeleton subclass for performing query and update operations on the 'calendar_regularEvent' table.
 *
 * Eventos repetidos anio a anio
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.calendar.classes
 */
class CalendarRegularEventQuery extends BaseCalendarRegularEventQuery {

	/**
	 * Constructor
	 *
	 * @return condicion por defecto al construir la instancia
	 */
	public function __construct($dbName = 'application', $modelName = 'CalendarRegularEvent', $modelAlias = null) {
		parent::__construct($dbName, $modelName, $modelAlias);
			$this->orderByDate(Criteria::ASC);
	}

} // CalendarRegularEventQuery
