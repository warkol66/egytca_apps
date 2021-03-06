<?php

class ActorsCategoryDoDeleteAction extends BaseAction {

	function ActorsDoDeleteAction() {
		;
	}

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
		$category = ActorCategoryPeer::get($_POST["id"]);
		if ($category->isRoot())
			ActorCategoryPeer::deleteTree($category->getScope());
		else		
			ActorCategoryPeer::delete($_POST["id"]);
		return $mapping->findForwardConfig('success');
	}

}
