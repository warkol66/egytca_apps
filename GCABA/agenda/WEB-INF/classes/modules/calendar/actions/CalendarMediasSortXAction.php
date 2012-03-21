<?php

class CalendarMediasSortXAction extends BaseAction {

	function CalendarMediasSortXAction() {
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
		$section = "Media";
		$smarty->assign("section",$section);				

		parse_str($_POST['data']);

		if (isset($imagesList))
			$list = $imagesList;
		if (isset($soundsList))
			$list = $soundsList;
		if (isset($videosList))
			$list = $soundsList;
			
		for ($pos = 0; $pos < count($list); $pos++) {
			CalendarMediaPeer::changeCalendarMediaOrder($list[$pos],$pos);
	   	}
	
		return $mapping->findForwardConfig('success');
	}

}
