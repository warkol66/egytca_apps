<?php



/**
 * Skeleton subclass for representing a row from the 'calendar_thematicWeek' table.
 *
 * Semanas tematicas
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.calendar.classes
 */
class ThematicWeek extends BaseThematicWeek {


	/**
	 * Crea las semanas tematicas par aun nio determinado
	 *
	 * @param      year integer el anio al que se le crearan las semanas
	 */
	public static function createYearWeeks($year) {

		$firstDayOfYear = mktime(0, 0, 0, 1, 1, $year);
		$nextMonday     = strtotime('monday', $firstDayOfYear);
		$nextSunday     = strtotime('sunday', $nextMonday);
		$i = 1;

		while (date('Y', $nextMonday) == $year) {
			$thematicWeek = new ThematicWeek();
			$thematicWeek->setWeekNumber($i);
			$thematicWeek->setYear($year);
			$thematicWeek->setMonday($nextMonday);
			$thematicWeek->setSunday($nextSunday);
			try {
				$thematicWeek->save();
			}
			catch (PropelException $exp) {
				if (ConfigModule::get("global","showPropelExceptions"))
					print_r($exp->getMessage());
			}
			$nextMonday = strtotime('+1 week', $nextMonday);
			$nextSunday = strtotime('+1 week', $nextSunday);
			$i++;
		}
	}

	/**
	 * Obtiene el eje asociado
	 *
	 * @return     El CalendarAxis o la frase que no se ha elegido eje.
	 */
	public function getSelectedAxis() {

		$axis = $this->getCalendarAxis();
		if (empty($axis))
			return "No se ha seleccionado eje";
		else
			return $axis;
	}

} // ThematicWeek
