<?php

class CalendarEventsPreviewAction extends BaseAction {

	function CalendarEventsPreviewAction() {
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

		$preview = CalendarEventPeer::createPreview($_POST['calendarEvent']);
		
		//caso de preview en Home
		if ($_POST['mode'] == 'home') {
			
			$this->template->template = "TemplateNewsHome.tpl";
			$events = array();
			array_push($events,$preview);
			$smarty->assign("calendarEvents",$events);

			return $mapping->findForwardConfig('success-home');
		}
		
		//caso de preview detallado
		if ($_POST['mode'] == 'detailed') {

			$this->template->template = "TemplateNewsPublic.tpl";
		
			$smarty->assign('calendarEvent',$preview);

			return $mapping->findForwardConfig('success-detailed');

		}

	}

}