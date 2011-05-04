<?php

require_once("BaseAction.php");
require_once("mer/ActorPeer.php");

class ActorsDoEditActorCategoryAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ActorsDoEditActorCategoryAction() {
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

		$module = "Actors";
		$section = "Configure";
		
    $smarty->assign("module",$module);
    $smarty->assign("section",$section);

    $actorPeer = new ActorPeer();

    if ( !empty($_POST["id"]) ) {
			//voy a editar un actor

			$actor = $actorPeer->get($_POST["id"]);
			$actorPeer->saveWithCategory($_POST["id"],$_POST["name"],$_POST["category"]);
		}
		
    if ($_REQUEST["action"]=="edit")
    	return $mapping->findForwardConfig('edit');		

		return $mapping->findForwardConfig('success');
	}

}
?>
