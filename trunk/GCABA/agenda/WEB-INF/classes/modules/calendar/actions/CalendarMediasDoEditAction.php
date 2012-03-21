<?php

class CalendarMediasDoEditAction extends BaseAction {

	function CalendarMediasDoEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "CalendarMedias";
		$smarty->assign("module",$module);
				

		if ( $_POST["action"] == "edit" ) {
			//estoy editando un calendarmedia existente

			CalendarMediaPeer::update($_POST["calendarMedia"]);

		}
		else {
		  //estoy creando un nuevo calendarmedia

			if ( !CalendarMediaPeer::create($_POST["calendarMedia"]) ) {
				$calendarMedia = new CalendarMedia();
			$calendarMedia->setid($_POST["calendarMedia"]["id"]);
			$calendarMedia->setcalendarEventId($_POST["calendarMedia"]["calendarEventId"]);
			$smarty->assign("calendarEventIdValues",CalendarEventPeer::getAll());
			$calendarMedia->setname($_POST["calendarMedia"]["name"]);
			$calendarMedia->settitle($_POST["calendarMedia"]["title"]);
			$calendarMedia->setdescription($_POST["calendarMedia"]["description"]);
			$calendarMedia->setmediaType($_POST["calendarMedia"]["mediaType"]);
			$calendarMedia->setorder($_POST["calendarMedia"]["order"]);
			$calendarMedia->setcreationDate($_POST["calendarMedia"]["creationDate"]);
			$calendarMedia->setstatus($_POST["calendarMedia"]["status"]);
			$calendarMedia->setuserId($_POST["calendarMedia"]["userId"]);
			$smarty->assign("userIdValues",UserPeer::getAll());
				$smarty->assign("calendarMedia",$calendarMedia);	
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				return $this->addFiltersToForwards($_POST['filters'],$mapping,'failure');
      		}
			
		}
		
		//redireccionamos con las opciones correctas
		return $this->addFiltersToForwards($_POST['filters'],$mapping,'success');

	}

}