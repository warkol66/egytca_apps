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
	
	/**
	 * Filtra por id de actores
	 *  $actorId int id del actor a buscar
	 *
	 * @return condicion de filtrado por actores afectados
	 */
	public function searchActorId($actorId) {
//		echo "actorId: ";print_r($actorId);echo "<br/>";
		return $this->useEventActorQuery()
			->filterByActorid($actorId)
			->endUse();
	}
	
	/**
	 * Filtra por categorias
	 *  $categoryId int id de la categoria a buscar
	 *
	 * @return condicion de filtrado por categorias afectadas
	 */
	public function searchCategoryId($categoryId) {
		return $this->useEventCategoryQuery()
			->filterByCategoryid($categoryId)
			->endUse();
	}
	
	/**
	 * Filters the query to target only CalendarEvent objects.
	 */
	public function preSelect(PropelPDO $con)
	{
		$this->addUsingAlias(CalendarEventPeer::CLASS_KEY, CalendarEventPeer::CLASSKEY_1);
	}

	/**
	 * Filters the query to target only CalendarEvent objects.
	 */
	public function preUpdate(&$values, PropelPDO $con, $forceIndividualSaves = false)
	{
		$this->addUsingAlias(CalendarEventPeer::CLASS_KEY, CalendarEventPeer::CLASSKEY_1);
	}

	/**
	 * Filters the query to target only CalendarEvent objects.
	 */
	public function preDelete(PropelPDO $con)
	{
		$this->addUsingAlias(CalendarEventPeer::CLASS_KEY, CalendarEventPeer::CLASSKEY_1);
	}

} // CalendarEventQuery
