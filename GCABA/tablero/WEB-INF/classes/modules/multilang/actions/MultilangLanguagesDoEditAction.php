<?php

require_once("BaseAction.php");
require_once("MultilangLanguagePeer.php");

class MultilangLanguagesDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function MultilangLanguagesDoEditAction() {
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

		$modulo = "Multilang";

		if ( $_POST["action"] == "edit" ) {
			//estoy editando un language existente

			if ( MultilangLanguagePeer::update($_POST["id"],$_POST["name"],$_POST["code"],$_POST["locale"]) )
      			return $mapping->findForwardConfig('success');
      		else
      			return $mapping->findForwardConfig('success');

		}
		else {
		  //estoy creando un nuevo language

			if ( !MultilangLanguagePeer::create($_POST["name"],$_POST["code"],$_POST["locale"]) ) {
				$smarty->assign("id",$_POST["id"]);
				$smarty->assign("name",$_POST["name"]);
				$smarty->assign("code",$_POST["code"]);
				$smarty->assign("locale",$_POST["locale"]);
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				return $mapping->findForwardConfig('failure');
      		}
			Common::doLog("success",$_POST["name"]);
			return $mapping->findForwardConfig('success');
		}

	}

}
