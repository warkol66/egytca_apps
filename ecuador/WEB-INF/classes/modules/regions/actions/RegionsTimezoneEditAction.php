<?php

require_once("BaseAction.php");
require_once("RegionTimezonePeer.php");
require_once("RegionTimezone.php");

class RegionsTimezoneEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function RegionsTimezoneEditAction() {
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

		$module = "RegionsTimezone";
		$smarty->assign("module",$module);

		$RegionTimezonePeer = new RegionTimezonePeer();
		$continents = $RegionTimezonePeer->continents;
		$smarty->assign("continents",$continents);

		if ( !empty($_GET["id"]) ) {
			$region = RegionTimezonePeer::get($_GET["id"]);
			$smarty->assign("region",$region);
			$smarty->assign("action","edit");
			$regionstimezone =  RegionTimezonePeer::getIdentifiers($continent);
		}
		else {
			//voy a crear un region nuevo
			$region = new Region();
			$smarty->assign("region",$region);
			$smarty->assign("action","create");
			$regionstimezone =  RegionTimezonePeer::getIdentifiers();
		}

		$smarty->assign("message",$_GET["message"]);
		$smarty->assign('regionstimezone',$regionstimezone);

		return $mapping->findForwardConfig('success');
	}

}
