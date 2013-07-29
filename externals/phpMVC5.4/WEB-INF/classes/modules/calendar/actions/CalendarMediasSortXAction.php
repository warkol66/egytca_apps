<?php

class CalendarMediasSortXAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function CalendarMediasSortXAction() {
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
		$section = "Media";
		$smarty->assign("section",$section);				

		//por ser un action ajax
		$this->template->template = 'TemplateAjax.tpl';
 

		parse_str($_POST['data']);

		if (isset($imagesList))
			$list = $imagesList;
		/*if (isset($soundsList))
			$list = $soundsList;
		if (isset($videosList))
			$list = $soundsList;*/
			
		for ($pos = 0; $pos < count($list); $pos++) {
			CalendarMedia::changeCalendarMediaOrder($list[$pos],$pos);
	   	}
	
		return $mapping->findForwardConfig('success');
	}

}
