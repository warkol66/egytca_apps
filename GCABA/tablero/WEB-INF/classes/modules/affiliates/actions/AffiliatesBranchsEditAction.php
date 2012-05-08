<?php

require_once("BaseAction.php");
require_once("BranchPeer.php");
require_once("AffiliatePeer.php");

class AffiliatesBranchsEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function AffiliatesBranchsEditAction() {
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

		$module = "Affiliates";
		$section = "Branchs";
		
		if (!empty($_SESSION["loginUser"])) {		
			$affiliates = AffiliatePeer::getAll();
			$smarty->assign("affiliates",$affiliates);			
			$smarty->assign("all",1);
		}
		else {
			$smarty->assign("all",0);
		}		

		if ( !empty($_GET["id"]) ) {
			//voy a editar un branch

			$branch = BranchPeer::get($_GET["id"]);

			$smarty->assign("branch",$branch);
																				
	    	$smarty->assign("action","edit");
		}
		else {
			//voy a crear un branch nuevo
																								
			$smarty->assign("action","create");
		}

		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
?>
