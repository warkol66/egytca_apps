<?php



/**
 * Skeleton subclass for representing a row from the 'calendar_regularEvent' table.
 *
 * Eventos repetidos anio a anio
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.calendar.classes
 */
class CalendarRegularEvent extends BaseCalendarRegularEvent {
	
	public static function getUninstantiated($year) {
		
		$regularEvents = CalendarRegularEventQuery::create()->find();
		$uninstantiated = array();
		foreach ($regularEvents as $regularEvent) {
			if (!$regularEvent->isInstantiated($year)) {
				$uninstantiated[] = $regularEvent;
			}
		}
		return $uninstantiated;
	}
	
	/**
	 * Devuelve true si existe un CalendarHolidayEvent con la fecha del RegularEvent para el año $year
	 * 
	 * @param int $year 
	 * @return boolean
	 */
	public function isInstantiated($year) {
		$holidays = CalendarHolidayEventQuery::create()->filterByRegulareventid(null, Criteria::NOT_EQUAL)->find();
		foreach ($holidays as $holiday) {
			if ($this->getDate('%d-%m').'-'.$year == $holiday->getStartDate('%d-%m-%Y')) {
				return true;
			}
		}
		return false;
	}

} // CalendarRegularEvent
