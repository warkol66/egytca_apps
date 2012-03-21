<?php

class CalendarMediasGetImageAction extends BaseAction {

	function CalendarMediasGetImageAction() {
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
			$file = $moduleRootDir."/WEB-INF/classes/modules/calendar/files/images/";
			if (!empty($_GET["tn"])) 
				$file .= "thumbnails";
			else 
				$file .= "resizes";
			$file .= "/".$_GET["id"];
			readfile($file);
			die;
		}

	}

}
