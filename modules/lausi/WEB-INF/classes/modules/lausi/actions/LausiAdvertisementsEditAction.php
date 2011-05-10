<?php

class LausiAdvertisementsEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function LausiAdvertisementsEditAction() {
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

    	if ( !empty($_GET["id"]) ) {
			$advertisement = AdvertisementPeer::get($_GET["id"]);
			$smarty->assign("advertisement",$advertisement);
	    	$smarty->assign("action","edit");
		} else {
			$advertisement = new Advertisement();
			$smarty->assign("advertisement",$advertisement);			
			$smarty->assign("action","create");
		}
		
		if (!empty($_GET['addressId'])) {
			$address = AddressPeer::get($_GET['addressId']);
			if ($address != null)
				$billboards = $address->getBillboards();
			else
				$billboards = BillboardPeer::getAll();
		} else { 
			$billboards = BillboardPeer::getAll();
		}
		
		$smarty->assign("advertisement",$advertisement);
		$smarty->assign("billboardIdValues",$billboards);
		$smarty->assign("themeIdValues",ThemePeer::getAllActive());
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
