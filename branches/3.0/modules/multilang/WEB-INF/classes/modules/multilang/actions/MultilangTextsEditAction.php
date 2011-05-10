<?php

require_once("BaseAction.php");
require_once("MultilangLanguagePeer.php");

class MultilangTextsEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function MultilangTextsEditAction() {
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

		$module = "Multilang";
		$smarty->assign('module',$module);
		
		//asigno todo los modulos posibles para que se pueda seleccionar
		$modules = ModulePeer::getAll();
		$smarty->assign('modules',$modules);


    	if ( !empty($_GET["id"]) ) {
			//voy a editar un text

			$texts = MultilangTextPeer::getByIdAndModuleName($_GET["id"],$_GET["moduleName"]);
			$smarty->assign("texts",$texts);
			$smarty->assign("textId",$_GET["id"]);
			$smarty->assign("currentPage",$_GET["currentPage"]);

	    	$smarty->assign("action","edit");
		}
		else {
			//voy a crear un text nuevo
									
			$smarty->assign("action","create");
		}

		$smarty->assign("moduleName",$_GET["moduleName"]);

    	$appLanguages = MultilangLanguagePeer::getAll();
    	$smarty->assign("appLanguages",$appLanguages);

		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
