<?php

class CalendarEventsGetThumbnailAction extends BaseAction {

	function CalendarEventsGetThumbnailAction() {
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

		global $moduleRootDir;


		if ( !empty($_GET["id"]) ) {
			$calendarEvent = CalendarEventPeer::get($_GET["id"]);
			if (!empty($calendarEvent)) {
				$image = $calendarEvent->getFirstImage();
				if (!empty($image)) {
					$file = $moduleRootDir."/WEB-INF/classes/modules/calendar/files/images/";
					$file .= "thumbnails";
					$file .= "/".$image->getId();//print_r($file);die;
					//header('Content-Type: image/jpeg');
					readfile($file);
					die;				
				}
			}
		}

	}

}
