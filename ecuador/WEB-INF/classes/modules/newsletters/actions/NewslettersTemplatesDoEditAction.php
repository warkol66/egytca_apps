<?php

class NewslettersTemplatesDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function NewslettersTemplatesDoEditAction() {
		;
	}

	function validate() {		
		
		return (!empty($_POST["newslettertemplate"]["name"]));
		
	}

	function manageEditFailure($mapping,$smarty) {
		
		$newsletterTemplate = NewsletterTemplatePeer::get($_POST["newslettertemplate"]['id']);
		$smarty->assign('newslettertemplate',$newsletterTemplate);
		
		$smarty->assign("action","edit");
		$smarty->assign("message","error");
		return $mapping->findForwardConfig('failure');
	}
	
	function manageCreateFailure($mapping,$smarty) {
		
		$newslettertemplate = new NewsletterTemplate();
		$newslettertemplate->setid($_POST["newslettertemplate"]["id"]);
		$newslettertemplate->setname($_POST["newslettertemplate"]["name"]);
		$newslettertemplate->setcontent($_POST["newslettertemplate"]["content"]);
		$newslettertemplate->setnewsletterTemplateExternalId($_POST["newslettertemplate"]["newsletterTemplateExternalId"]);
		require_once("NewsletterTemplateExternalPeer.php");		
		$smarty->assign("newsletterTemplateExternalIdValues",NewsletterTemplateExternalPeer::getAll());
		$smarty->assign("newslettertemplate",$newslettertemplate);	
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
		$section = "NewsletterTemplates";
		$smarty->assign("section",$section);		

		if ( $_POST["action"] == "edit" ) {
			//estoy editando un newslettertemplate existente

			if (!$this->validate())
				return $this->manageEditFailure($mapping,$smarty);

			NewsletterTemplatePeer::update($_POST["newslettertemplate"]);
      		
			return $mapping->findForwardConfig('success');

		}
		else {
		  //estoy creando un nuevo newslettertemplate

			if (!$this->validate())
				return $this->manageCreateFailure($mapping,$smarty);

			if ( !NewsletterTemplatePeer::create($_POST["newslettertemplate"]))
				return $this->manageCreateFailure($mapping,$smarty);
				

			return $mapping->findForwardConfig('success');
		}

	}

}
