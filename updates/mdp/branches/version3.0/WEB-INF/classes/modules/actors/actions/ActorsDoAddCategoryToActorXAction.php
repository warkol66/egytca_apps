<?php

class ActorsDoAddCategoryToActorXAction extends BaseAction {

	function ActorsDoAddCategoryToActorXAction() {
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

		if (!empty($_POST["actorId"]) && !(empty($_POST["categoryId"]))) {

			$actor = ActorPeer::get($_POST["actorId"]);
			$category = ActorCategoryPeer::get($_POST["categoryId"]);

			$smarty->assign('actor',$actor);
			$smarty->assign('category',$category);

			$relationParams["actorId"] = $_POST["actorId"];
			$relationParams["categoryId"] = $_POST["categoryId"];

			if (!empty($actor) && !empty($category)) {

				$relation = setObjectFromParams(new ActorCategoryRelation(),$relationParams);

				if ($relation->save())
					return $mapping->findForwardConfig('success');
				else {
					$smarty->assign('errorTagId','categoryMsgField');
					return $mapping->findForwardConfig('failure');
				}

			}

		}

		$smarty->assign('errorTagId','categoryMsgField');
		return $mapping->findForwardConfig('failure');
	}

}
