<?php

class CalendarPreviewAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function CalendarEventsPreviewAction() {
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

		$module = "Calendar";
		$smarty->assign("module",$module);

		$preview = CalendarEvent::createPreview($_POST['params']);
		
		//caso de preview en Home
		if ($_POST['mode'] == 'home') {
			
			$this->template->template = "TemplateNewsHome.tpl";
			$events = array();
			array_push($events,$preview);
			$smarty->assign("calendarEventColl",$events);

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
