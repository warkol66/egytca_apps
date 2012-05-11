<?php

class CalendarHolidayEventsDoEditAction extends BaseAction {

	function CalendarHolidayEventsDoEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Calendar";
		$smarty->assign("module",$module);
				
		$id = $request->getParameter("id");
		$calendarEvent = CalendarHolidayEventQuery::create()->findOneById($id);
		if (!empty($calendarEvent))
			$calendarEvent = Common::setObjectFromParams($calendarEvent, $_POST['calendarEvent']);
		else {
			//estoy creando un nuevo evento
			$calendarEvent = new CalendarHolidayEvent();
			$calendarEvent = Common::setObjectFromParams($calendarEvent, $_POST['calendarEvent']);
		}

		$this->updateRegions($calendarEvent);
		$this->updateCategories($calendarEvent);
		$this->updateActors($calendarEvent);
		
		try {
			$calendarEvent->save();
		} catch (Exception $e) {
			$smarty->assign("regions", RegionQuery::create()->find());
			$smarty->assign("categories", CategoryQuery::create()->find());
			$smarty->assign("users", UserQuery::create()->find());
			$smarty->assign("calendarEvent",$calendarEvent);	
			$smarty->assign("action","create");
			$smarty->assign("message","error");
			return $this->addFiltersToForwards($_POST['filters'],$mapping,'failure');
		}
		
		/*
		 * Elijo la vista basado en si es o no un pedido por AJAX 
		 */
		if ($this->isAjax()) {
			$smarty->assign('event', $calendarEvent);
			$smarty->display('CalendarEventsDoEditX.tpl'); // no need for return
		} else {
			//redireccionamiento con opciones correctas
			return $this->addFiltersToForwards($_POST['filters'],$mapping,'success');
		}

	}
	
	private function updateRegions($calendarEvent) {
		$regionsIds = $_POST['calendarEvent']['regionsIds'];
		if (empty($regionsIds))
			$regionsIds = array();
		
		$oldRegionsIds = array();
		foreach (EventRegionQuery::create()->findByEventid($calendarEvent->getId()) as $e) {
			$oldRegionsIds[] = $e->getRegionid();
		}
		
		$regionsIdsForRemoval = array_diff($oldRegionsIds, $regionsIds);
		foreach ($regionsIdsForRemoval as $regionIdForRemoval) {
			$eventRegion = EventRegionQuery::create()->findOneByRegionid($regionIdForRemoval);
			$eventRegion->delete();
		}

		foreach ($regionsIds as $regionId) {
			$region = RegionQuery::create()->findOneById($regionId);
			if (!$calendarEvent->hasRegion($region)) {
				$calendarEvent->addRegion($region);
			}
		}
	}
	
	private function updateCategories($calendarEvent) {
		$categoriesIds = $_POST['calendarEvent']['categoriesIds'];
		if (empty($categoriesIds))
			$categoriesIds = array();
		
		$oldCategoriesIds = array();
		foreach (EventCategoryQuery::create()->findByEventid($calendarEvent->getId()) as $e) {
			$oldCategoriesIds[] = $e->getCategoryid();
		}
		
		$categoriesIdsForRemoval = array_diff($oldCategoriesIds, $categoriesIds);
		foreach ($categoriesIdsForRemoval as $categoryIdForRemoval) {
			$eventCategory = EventCategoryQuery::create()->findOneByCategoryid($categoryIdForRemoval);
			$eventCategory->delete();
		}
		
		foreach ($categoriesIds as $categoryId) {
			$category = CategoryQuery::create()->findOneById($categoryId);
			if (!$calendarEvent->hasCategory($category)) {
				$calendarEvent->addCategory($category);
			}
		}
	}
	
	private function updateActors($calendarEvent) {
		$actorsIds = $_POST['calendarEvent']['actorsIds'];
		if (empty($actorsIds))
			$actorsIds = array();
		
		$oldActorsIds = array();
		foreach (EventActorQuery::create()->findByEventid($calendarEvent->getId()) as $e) {
			$oldActorsIds[] = $e->getActorid();
		}
		
		$actorsIdsForRemoval = array_diff($oldActorsIds, $actorsIds);
		foreach ($actorsIdsForRemoval as $actorIdForRemoval) {
			$eventActor = EventActorQuery::create()->findOneByActorid($actorIdForRemoval);
			$eventActor->delete();
		}
		
		foreach ($actorsIds as $actorId) {
			$actor = RegionQuery::create()->findOneById($actorId);
			if (!$calendarEvent->hasActor($actor)) {
				$calendarEvent->addActor($actor);
			}
		}
	}
	
	private function updateAxes($calendarEvent) {
		$axesIds = $_POST['calendarEvent']['axesIds'];
		if (empty($axesIds))
			$axesIds = array();
		
		$oldAxesIds = array();
		foreach (EventAxisQuery::create()->findByEventid($calendarEvent->getId()) as $e) {
			$oldAxesIds[] = $e->getAxisid();
		}
		
		$axesIdsForRemoval = array_diff($oldAxesIds, $axesIds);
		foreach ($axesIdsForRemoval as $axisIdForRemoval) {
			$eventAxis = EventAxisQuery::create()->findOneByAxisid($axisIdForRemoval);
			$eventAxis->delete();
		}
		
		foreach ($axesIds as $axisId) {
			$axis = CalendarAxisQuery::create()->findOneById($axisId);
			if (!$calendarEvent->hasCalendarAxis($axis)) {
				$calendarEvent->addCalendarAxis($axis);
			}
		}
	}

}