<?php

require_once("BaseAction.php");

class ObjectivesPurgeLogsAction extends BaseAction {

	// ----- Constructor ---------------------------------------------------- //

	function ObjectivesPurgeLogsAction() {
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
		global $system;

		$module = "Objectives";
		$section = "Objectives";

   		$smarty->assign("module",$module);
    	$smarty->assign("section",$section);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);
		
		$dateFormat = $system['config']['system']['parameters']['dateFormat']['value'];
		$datePickerDateFormat = Common::getDatePickerDateFormat();
		
		$defaulDate = date($dateFormat, mktime(0, 0, 0, date("m")-1, date("d"),   date("Y")));
		$smarty->assign("defaultDate",$defaulDate);
		$smarty->assign("dateFormat",$dateFormat);
		$smarty->assign("datePickerDateFormat",$datePickerDateFormat);

		return $mapping->findForwardConfig('success');
	}

}
