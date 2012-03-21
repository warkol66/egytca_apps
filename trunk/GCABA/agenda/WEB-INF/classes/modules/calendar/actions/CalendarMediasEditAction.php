<?php

class CalendarMediasEditAction extends BaseAction {

	function CalendarMediasEditAction() {
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
				

    if ( !empty($_GET["id"]) ) {
			//voy a editar un calendarmedia

			$calendarMedia = CalendarMediaPeer::get($_GET["id"]);
			$smarty->assign("calendarMedia",$calendarMedia);
			require_once("CalendarEventPeer.php");		
			$smarty->assign("calendarIdValues",calendarEventPeer::getAll());
			require_once("UserPeer.php");		
			$smarty->assign("userIdValues",UserPeer::getAll());

	    	$smarty->assign("action","edit");
		}
		else {
			//voy a crear un calendarmedia nuevo
			$calendarMedia = new CalendarMedia();
			$smarty->assign("calendarMedia",$calendarMedia);
			require_once("CalendarEventPeer.php");		
			$smarty->assign("calendarIdValues",CalendarEventPeer::getAll());
			require_once("UserPeer.php");		
			$smarty->assign("userIdValues",UserPeer::getAll());

			$smarty->assign("action","create");
		}
		
		if (!empty($_GET['filters']))
			$smarty->assign('filters',$_GET['filters']);
		

		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}