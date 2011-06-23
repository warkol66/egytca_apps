<?php

class ActorsDoDeleteCategoryFromActorXAction extends BaseAction {

	function ActorsDoDeleteCategoryFromActorXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//por ser una action ajax.
		$this->template->template = "TemplateAjax.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Actors";

		//TODO VERIFICACION USUARIOS
		if (!empty($_POST["actorId"]) && !(empty($_POST["categoryId"]))) {

			$actor = ActorPeer::get($_POST["actorId"]);
			$category = ActorCategoryPeer::get($_POST["categoryId"]);

			if (!empty($actor) && !empty($category)) {
				ActorCategoryRelationPeer::delete($_POST["actorId"],$_POST["categoryId"]);
				$smarty->assign('category',$category);
			}

		}

		return $mapping->findForwardConfig('success');
	}

}
