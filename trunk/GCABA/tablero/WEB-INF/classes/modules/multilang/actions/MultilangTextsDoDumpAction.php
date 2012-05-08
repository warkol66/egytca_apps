<?php

require_once("BaseAction.php");
require_once("MultilangLanguagePeer.php");

class MultilangTextsDoDumpAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function MultilangTextsDoDumpAction() {
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

		if (isset($_GET["moduleName"]) && isset($_GET["languageCode"])) {
    	/**
     	* Use a different template
     	*/
			$this->template->template = "TemplatePlain.tpl";

			$dump = MultilangTextPeer::getSQLCleanup($_GET["moduleName"],$_GET["languageCode"])."\n";				
			$allMultilangText = MultilangTextPeer::getAllByModuleAndLanguage($_GET["moduleName"],$_GET["languageCode"]);
	
			foreach ($allMultilangText as $multilangText)
				$dump .= $multilangText->getSQLInsert()."\n";

			header("content-disposition: attachment; filename=multilangText_".$_GET["languageCode"].".sql");
			header("Content-type: text/sql; charset=UTF-8");

    	$smarty->assign("dump",$dump);
			return $mapping->findForwardConfig('success');
    
		}

		return $mapping->findForwardConfig('failure');
	}

}
