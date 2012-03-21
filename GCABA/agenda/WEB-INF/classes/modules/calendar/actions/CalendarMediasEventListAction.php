<?php

class CalendarMediasEventListAction extends BaseAction {

	function CalendarMediasArticleListAction() {
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
 
 		$calendarEvent = CalendarEventPeer::get($_REQUEST['calendarEventId']);
		$smarty->assign("images",$calendarEvent->getImages());

 		$smarty->assign("created",$_REQUEST["created"]);

		return $mapping->findForwardConfig('success');
	}

}