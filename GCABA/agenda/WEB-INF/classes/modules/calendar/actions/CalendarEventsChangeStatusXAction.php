<?php

class CalendarEventsChangeStatusXAction extends BaseAction {

	function CalendarEventsChangeStatusXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

   	BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		//por ser una llamada via ajax
		$this->template->template = 'TemplateAjax.tpl';

		$module = "Calendar";
		$smarty->assign("module",$module);
		
		//caso de actualizacion de un solo evento
		if (isset($_POST['calendarEvent']))
			CalendarEventPeer::update($_POST['calendarEvent']);
		
		//cambio de status de varios elementos
		if (isset($_POST['status']) && isset($_POST['selected'])) {
			
			foreach ($_POST['selected'] as $id) {
				$calendarEvent['id'] = $id;
				$calendarEvent['status'] = $_POST['status'];
				CalendarEventPeer::update($calendarEvent);
			}
		}

		return $mapping->findForwardConfig('success');

	}

}