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

			calendarEventPeer::update($_POST["calendarEvent"]);
      	

		}
		else {
		  //estoy creando un nuevo evento

			if ( !CalendarEventPeer::create($_POST["calendarEvent"]) ) {
				$calendarEvent = new calendarEvent();
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
			require_once("RegionPeer.php");		
			$smarty->assign("regionIdValues",RegionPeer::getAll());
			$calendarEvent->setcategoryId($_POST["calendarEvent"]["categoryId"]);
			require_once("CategoryPeer.php");		
			$smarty->assign("categoryIdValues",CategoryPeer::getAll());
			$calendarEvent->setuserId($_POST["calendarEvent"]["userId"]);
			require_once("UserPeer.php");		
			$smarty->assign("userIdValues",UserPeer::getAll());
				$smarty->assign("calendarEvent",$calendarEvent);	
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				return $this->addFiltersToForwards($_POST['filters'],$mapping,'failure');
			}
      }
	  
		//redireccionamiento con opciones correctas
		return $this->addFiltersToForwards($_POST['filters'],$mapping,'success');

	}

}