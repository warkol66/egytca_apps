<?php

require_once("BaseAction.php");
require_once("AdvertisementPeer.php");
require_once("ThemePeer.php");

class LausiCampaignsDoExtensionXAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function LausiCampaignsDoExtensionXAction() {
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

		//por ser una action ajax.		
		$this->template->template = "template_ajax.tpl";


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


		if (empty($_POST['extension']) && $_POST['extension'] <= 0)
			return $mapping->findForwardConfig('failure');

		$toExtend = $_POST['toExtend'];
		$extension = $_POST['extension'];
		$extensionFailure = array();

		foreach($toExtend as $advertId) {

			if (!AdvertisementPeer::extendAdvertisement($advertId,$extension)) {
				//si se produce un error lo guardo como que no pudo actualizarse
				array_push($extensionFailure,$advertId);		
			}
			
		}

		$smarty->assign('formId',$_POST['formId']);
		$smarty->assign('extensionFailure',$extensionFailure);
		
		return $mapping->findForwardConfig('success');
	}

}
