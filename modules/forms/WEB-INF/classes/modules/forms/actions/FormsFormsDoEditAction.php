<?php

require_once("BaseAction.php");
require_once("FormPeer.php");

class FormsFormsDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function FormsFormsDoEditAction() {
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

		$_POST['form']['content'] = stripslashes($_POST['form']['content']);

		$module = "Forms";
		$smarty->assign("module",$module);
		$section = "Forms";
		$smarty->assign("section",$section);		

		if ( $_POST["action"] == "edit" ) {
			//estoy editando un form existente

			FormPeer::update($_POST["form"]);
      		
			return $mapping->findForwardConfig('success');

		}
		else {
		  //estoy creando un nuevo form

			if ( !FormPeer::create($_POST["form"]) ) {
				$form = new Form();
			$form->setid($_POST["form"]["id"]);
			$form->setmailsTo($_POST["form"]["mailsTo"]);
			$form->setcontent($_POST["form"]["content"]);
			$form->setalwaysActive($_POST["form"]["alwaysActive"]);
			$form->sethasCategories($_POST["form"]["hasCategories"]);
			$form->setredirectUrl($_POST["form"]["redirectUrl"]);
			$form->setredirectMessage($_POST["form"]["redirectMessage"]);
			$form->sethasCaptcha($_POST["form"]["hasCaptcha"]);
				$smarty->assign("form",$form);	
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				return $mapping->findForwardConfig('failure');
      }

			return $mapping->findForwardConfig('success');
		}

	}

}