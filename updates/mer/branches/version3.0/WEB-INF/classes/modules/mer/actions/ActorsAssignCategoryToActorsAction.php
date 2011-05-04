<?php

class ActorsAssignCategoryToActorsAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ActorsAssignCategoryToActorsAction() {
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

		$categoryPeer = new CategoryPeer();
		$categories = $categoryPeer->getUserCategories($_SESSION["login_user"]);
		$smarty->assign("categories",$categories);

		$actorPeer = new ActorPeer();
		$actors = $actorPeer->getActorsWithNoCategory();
		$smarty->assign("actors",$actors);

		if ( !empty($_GET["cat"]) ) {
			$actorsCategory = $actorPeer->getByCategory($_GET["cat"]);
			$smarty->assign("actorsCategory",$actorsCategory);
			$category = $categoryPeer->get($_GET["cat"]);
			$smarty->assign("currentCategory",$category);
		}

		return $mapping->findForwardConfig('success');
	}

}
?>
