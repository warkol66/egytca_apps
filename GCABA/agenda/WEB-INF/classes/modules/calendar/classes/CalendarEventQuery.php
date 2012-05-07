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
	 * Devuelve array con tipos (kinds) de evento
	 *  id => Tipo de agenda
	 *
	 * @return array tipos de agenda
	 */
	public function getEventKinds() {
		$agendaType = array(
			1 => 'AAA',
			2 => 'Otros eventos',
			3 => 'Agenda Cultural',
		);
		return $agendaType;
	}

	/**
	 * Devuelve array con tipos (kinds) de evento
	 *  id => Tipo de agenda
	 *
	 * @return array tipos de agenda
	 */
	public function getAgendas() {
		$agendas = array(
			1 => 'Jefe de Gobierno',
			2 => 'Ministros',
			3 => 'Otros funcionarios',
		);
		return $agendas;
	}

	/**
	 * Filtra por regiones y sus descendientes
	 *  $regionId int id de la region a buscar
	 *
	 * @return condicion de filtrado por regiones afectadas
	 */
	public function searchRegionId($regionId) {
		$region = RegionQuery::create()->findOneById($regionId);
		if (!empty($region)) {
			$children = $region->getChildren();
			$regionIds = array($region->getId());
			foreach ($children as $child)
				$regionIds[] = $child->getId();

			return $this->useEventRegionQuery()
								->filterByRegionid($regionIds)
							->endUse();
		}
	}

} // CalendarEventQuery
