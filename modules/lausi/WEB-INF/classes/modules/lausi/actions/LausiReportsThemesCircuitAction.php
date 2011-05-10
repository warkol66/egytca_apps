<?php

require_once("BaseAction.php");
require_once("ReportGenerator.php");
require_once("BillboardPeer.php");
require_once('ThemePeer.php');

class LausiReportsThemesCircuitAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function LausiReportsThemesCircuitAction() {
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

		$module = "Lausi";
		$smarty->assign("module",$module);
		$section = "Advertisements";
		$smarty->assign("section",$section);

		$themes = ThemePeer::getAllActive();
		$smarty->assign('themes',$themes);
		
		if (!empty($_GET['themeId'])) {
			$theme = ThemePeer::get($_GET['themeId']);
			$smarty->assign('themeSelected',$theme);
			$reportGenerator = new ReportGenerator();
			$result = $reportGenerator->getThemeByCircuitReport($theme);
			$smarty->assign('result',$result);
		}
		
		if ($_REQUEST['print'] == '1')
			$this->template->template = "TemplatePrint.tpl";
		
		
		return $mapping->findForwardConfig('success');
	}

}
