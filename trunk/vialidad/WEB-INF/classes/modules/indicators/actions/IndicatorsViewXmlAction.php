<?php

require_once("BaseAction.php");

class IndicatorsViewXmlAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function IndicatorsViewXmlAction() {
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

		$module = "Indicators";
		$smarty->assign("module",$module);

		$this->template->template = 'TemplateAjax.tpl';
		header ("content-type: text/xml; charset=utf-8");

		//Encabezado BOM para que el flash chart identifique el UTF-8
		echo pack ( "C3" , 0xef, 0xbb, 0xbf );

		$indicatorsPeer = new IndicatorPeer();

		if ( !empty($_GET["id"]) ) {
			if (!empty($_GET["entity"])) {
				$indicator = IndicatorPeer::getDisbursementIndicator($_GET["entity"], $_GET["id"]);
				$smarty->assign("disbursement",true);
			} 
			else {
				$indicator = IndicatorPeer::get($_GET["id"]);

		if (method_exists($indicator,'getIndicatorCategorys'))
				$categories = $indicator->getIndicatorCategorys();
		
				foreach ($categories as $category)
					if ($category->getId() == -1)
					$smarty->assign("disbursement",true);
			}
			$smarty->assign("indicator",$indicator);
		}
		return $mapping->findForwardConfig('success');
	}
}


