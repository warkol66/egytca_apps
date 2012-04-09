<?php

class CalendarEventsDoEditAction extends BaseAction {

	function CalendarEventsDoEditAction() {
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
				

		if ( $_POST["action"] == "edit" ) {
			//estoy editando un evento existente
			CalendarEventPeer::update($_POST["calendarEvent"]);
			$calendarEvent = CalendarEventQuery::create()->findOneById($_POST['calendarEvent']['id']);
		}
		else {
		  //estoy creando un nuevo evento

			if ( !CalendarEventPeer::create($_POST["calendarEvent"]) ) {
				$calendarEvent = new CalendarEvent();
				$calendarEvent->setid($_POST["calendarEvent"]["id"]);
				$calendarEvent->settitle($_POST["calendarEvent"]["title"]);
				$calendarEvent->setsummary($_POST["calendarEvent"]["summary"]);
				$calendarEvent->setbody($_POST["calendarEvent"]["body"]);
				$calendarEvent->setsourceContact($_POST["calendarEvent"]["sourceContact"]);
				$calendarEvent->setcreationDate($_POST["calendarEvent"]["creationDate"]);
				$calendarEvent->setstartDate($_POST["calendarEvent"]["startDate"]);
				$calendarEvent->setendDate($_POST["calendarEvent"]["endDate"]);
				$calendarEvent->setstatus($_POST["calendarEvent"]["status"]);
				$calendarEvent->setregionId($_POST["calendarEvent"]["regionId"]);
				$calendarEvent->setcategoryId($_POST["calendarEvent"]["categoryId"]);
				$calendarEvent->setuserId($_POST["calendarEvent"]["userId"]);
				
				$smarty->assign("regions", RegionQuery::create()->find());
				$smarty->assign("categories", CategoryQuery::create()->find());
				$smarty->assign("users", UserQuery::create()->find());
				$smarty->assign("calendarEvent",$calendarEvent);	
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				return $this->addFiltersToForwards($_POST['filters'],$mapping,'failure');
			}
		}
		
		$this->updateRegions($calendarEvent);
		$this->updateCategories($calendarEvent);
		$this->updateActors($calendarEvent);
		$calendarEvent->save();
		
		//redireccionamiento con opciones correctas
		return $this->addFiltersToForwards($_POST['filters'],$mapping,'success');

	}
	
	private function updateRegions($calendarEvent) {
		$regionsIds = $_POST['calendarEvent']['regionsIds'];
		
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
		
		$oldActorsIds = array();
		foreach (EventActorQuery::create()->findByEventid($calendarEvent->getId()) as $e) {
			$oldActorsIds[] = $e->getActorid();
		}
		
		$actorsIdsForRemoval = array_diff($oldActorsIds, $oldActorsIds);
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

}