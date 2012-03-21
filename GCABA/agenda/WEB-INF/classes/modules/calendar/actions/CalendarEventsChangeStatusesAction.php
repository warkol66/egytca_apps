<?php

class CalendarEventsChangeStatusesAction extends BaseAction {

	function CalendarEventsChangeStatusesAction() {
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
		
		//cambio de status de varios elementos
		if (isset($_POST['status']) && isset($_POST['selected'])) {
			
			foreach ($_POST['selected'] as $id) {
				$calendarEvent['id'] = $id;
				$calendarEvent['status'] = $_POST['status'];
				CalendarEventPeer::update($calendarEvent);
			}
		}

		$myRedirectConfig = $mapping->findForwardConfig('success');
		$myRedirectPath = $myRedirectConfig->getpath();
		if ($_POST['page'])
			$queryData = '&page='.$_POST["page"];
			
		$myRedirectPath .= $queryData;
		$fc = new ForwardConfig($myRedirectPath, True);
		return $fc;
	

	}

}