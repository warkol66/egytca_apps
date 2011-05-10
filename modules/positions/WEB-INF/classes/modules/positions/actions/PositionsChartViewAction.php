<?php

class PositionsChartViewAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function PositionsChartViewAction() {
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

		$this->template->template = 'TemplateNoWrapper.tpl';

		$module = "Positions";
		$smarty->assign("module",$module);

		$smarty->assign("positionHeader",true);

		$versions = PositionPeer::getVersions();
		$smarty->assign("versions",$versions);
		
		//por defecto muestra la última versión
		$version = $versions[count($versions)-1];
		
		if (isset($_GET["version"])) {
			$version = $_GET["version"];
		}

		$tree = PositionPeer::getTree($version);
		$smarty->assign("positions",$tree);

		$smarty->assign("message",$_GET["message"]);		
		$smarty->assign("version",$version);

		return $mapping->findForwardConfig('success');
	}

}


