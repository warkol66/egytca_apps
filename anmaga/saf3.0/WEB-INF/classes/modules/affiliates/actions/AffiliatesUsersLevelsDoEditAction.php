<?php

require_once("BaseAction.php");

class AffiliatesUsersLevelsDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function AffiliatesUsersLevelsDoEditAction() {
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
		$section = "Levels";
		
	    $smarty->assign("module",$module);
	    $smarty->assign("section",$section);
		
		$levelParams = $_POST['levelParams'];
		
		if ( !empty($_POST["id"]) ) {
			//estoy editando un nivel de usuarios existente
			$level = AffiliateLevelPeer::get($_POST["id"]);
		} else {
			//estoy creando un nuevo nivel de usuarios
			$level = new AffiliateLevel;
		}
		Common::setObjectFromParams($level, $levelParams);
		if (!$level->save()) {
			$smarty->assign("currentLevel", $level);
			$smarty->assign("message","errorUpdate");
			return $mapping->findForwardConfig('failure');
		}

		return $mapping->findForwardConfig('success');
	}

}
?>
