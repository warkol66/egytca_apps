<?php

class NewslettersTemplateExternalsDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function NewslettersTemplateExternalsDoEditAction() {
		;
	}

	function validate($mapping,$smarty) {		

		return (!empty($_POST["newslettertemplateexternal"]["name"]));		

	}

	function manageEditFailure($mapping,$smarty) {

		$newsletterTemplateExternal = NewsletterTemplateExternalPeer::get($_POST["newslettertemplateexternal"]['id']);
		$smarty->assign('newslettertemplateexternal',$newsletterTemplateExternal);

		$smarty->assign("action","edit");
		$smarty->assign("message","error");
		return $mapping->findForwardConfig('failure');
	}
	
	function manageCreateFailure($mapping,$smarty) {
		
		$newslettertemplateexternal = new NewsletterTemplateExternal();
		$newslettertemplateexternal->setid($_POST["newslettertemplateexternal"]["id"]);
		$newslettertemplateexternal->setname($_POST["newslettertemplateexternal"]["name"]);
		$newslettertemplateexternal->setcontent($_POST["newslettertemplateexternal"]["content"]);
		$smarty->assign("newslettertemplateexternal",$newslettertemplateexternal);	
		$smarty->assign("action","create");
		$smarty->assign("message","error");	
		
		return $mapping->findForwardConfig('failure');		
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

		$module = "Newsletters";
		$smarty->assign("module",$module);
		$section = "NewsletterTemplateExternals";
		$smarty->assign("section",$section);		

		if ( $_POST["action"] == "edit" ) {
			//estoy editando un newslettertemplateexternal existente

			if (!$this->validate())
				return $this->manageEditFailure($mapping,$smarty);

			NewsletterTemplateExternalPeer::update($_POST["newslettertemplateexternal"]);
      		
			return $mapping->findForwardConfig('success');

		}
		else {
		  //estoy creando un nuevo newslettertemplateexternal

			if (!$this->validate())
				return $this->manageCreateFailure($mapping,$smarty);

			if (!NewsletterTemplateExternalPeer::create($_POST["newslettertemplateexternal"]))
				return $this->manageCreateFailure($mapping,$smarty);
				
			return $mapping->findForwardConfig('success');
		}

	}

}
