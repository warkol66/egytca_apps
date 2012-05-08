<?php

require_once("BaseAction.php");
require_once("TableroMeasureUnitPeer.php");

class TableroMeasureUnitsEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function TableroMeasureUnitsEditAction() {
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

		$module = "Tablero";
    $smarty->assign("module",$module);

		$section = "MeasureUnits";
    $smarty->assign("section",$section);

		$measureUnitPeer = new TableroMeasureUnitPeer();
		$measureTypes = $measureUnitPeer->getMeasureUnitTypesTranslated();
		$smarty->assign("measureTypes",$measureTypes);

    if ( !empty($_GET["id"]) ) {
			$measureunit = TableroMeasureUnitPeer::get($_GET["id"]);
			$smarty->assign("measureunit",$measureunit);						
	    $smarty->assign("action","edit");
		}
		else		
			$smarty->assign("action","create");

		$smarty->assign("page",$_GET["page"]);
		$smarty->assign("message",$_GET["message"]);
		return $mapping->findForwardConfig('success');
	}

}
