<?php



/**
 * Skeleton subclass for representing a row from the 'calendar_axis' table.
 *
 * Base de Ejes
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.calendar.classes
 */
class CalendarAxis extends BaseCalendarAxis {
	
	public function __toString() {
		return $this->getName();
	}
	
	public static function getIdToNameMap() {
		$map = array();
		foreach (CalendarAxisQuery::create()->find() as $axis) {
			$map[$axis->getId()] = $axis->getName();
		}
		return $map;
	}

} // CalendarAxis
