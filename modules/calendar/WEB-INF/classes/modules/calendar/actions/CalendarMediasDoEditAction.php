<?php

require_once("BaseAction.php");
require_once("CalendarMediaPeer.php");

class CalendarMediasDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function CalendarMediasDoEditAction() {
		;
	}


	// ----- Public Methods ------------------------------------------------- //

	/**
	* Process the specified HTTP request, and create the corresponding HTTP
	* response (or forward to another web component that will create it).
	* Return an <code>ActionForward</code> instance describing where and how
	* control should be forwarded, or <code>NULL</code> if the response has
	* already been completed.
	*
	* @param ActionConfig		The ActionConfig (mapping) used to select this instance
	* @param ActionForm			The optional ActionForm bean for this request (if any)
	* @param HttpRequestBase	The HTTP request we are processing
	* @param HttpRequestBase	The HTTP response we are creating
	* @public
	* @returns ActionForward
	*/
	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
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
			require_once("CalendarEventPeer.php");		
			$smarty->assign("calendarEventIdValues",CalendarEventPeer::getAll());
			$calendarMedia->setname($_POST["calendarMedia"]["name"]);
			$calendarMedia->settitle($_POST["calendarMedia"]["title"]);
			$calendarMedia->setdescription($_POST["calendarMedia"]["description"]);
			$calendarMedia->setmediaType($_POST["calendarMedia"]["mediaType"]);
			$calendarMedia->setorder($_POST["calendarMedia"]["order"]);
			$calendarMedia->setcreationDate($_POST["calendarMedia"]["creationDate"]);
			$calendarMedia->setstatus($_POST["calendarMedia"]["status"]);
			$calendarMedia->setuserId($_POST["calendarMedia"]["userId"]);
			require_once("UserPeer.php");		
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
