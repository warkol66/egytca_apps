<?php

require_once("BaseAction.php");
require_once("ProcessedFormPeer.php");

class FormsProcessedFormsDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function FormsProcessedFormsDoEditAction() {
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

		$module = "Forms";
		$smarty->assign("module",$module);
		$section = "ProcessedForms";
		$smarty->assign("section",$section);		

		if ( $_POST["action"] == "edit" ) {
			//estoy editando un processedform existente

			ProcessedFormPeer::update($_POST["processedform"]);
      		
			return $mapping->findForwardConfig('success');

		}
		else {
		  //estoy creando un nuevo processedform

			if ( !ProcessedFormPeer::create($_POST["processedform"]) ) {
				$processedform = new ProcessedForm();
			$processedform->setid($_POST["processedform"]["id"]);
			$processedform->setformId($_POST["processedform"]["formId"]);
			$processedform->setformFillingDate($_POST["processedform"]["formFillingDate"]);
			$processedform->setip($_POST["processedform"]["ip"]);
			$processedform->setprocessedContent($_POST["processedform"]["processedContent"]);
				$smarty->assign("processedform",$processedform);	
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				return $mapping->findForwardConfig('failure');
      }

			return $mapping->findForwardConfig('success');
		}

	}

}