<?php

class CalendarEventsViewAction extends BaseAction {

	function CalendarEventsViewAction() {
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
						
  	/**
   	* Use a different template
   	*/
		$this->template->template = "TemplateNewsPublic.tpl";

 		if ( !empty($_GET["id"]) ) {
			//voy a editar un calendarEvent
			$calendarEvent = CalendarEventPeer::get($_GET["id"]);
			$smarty->assign('calendarEvent',$calendarEvent);			
		}
		else {
			return $mapping->findForwardConfig('failure');			
		}
		
		return $mapping->findForwardConfig('success');
	}

}