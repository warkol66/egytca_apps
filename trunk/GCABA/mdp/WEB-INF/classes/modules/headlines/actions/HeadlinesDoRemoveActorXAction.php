<?php

class HeadlinesDoRemoveActorXAction extends BaseAction {

	function HeadlinesDoRemoveActorXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Headlines";

		if (!empty($_POST["headlineId"]) && !(empty($_POST["actorId"]))) {
		
			$headline = HeadlineQuery::create()->findPk($_POST["headlineId"]);
			$actor = ActorQuery::create()->findPk($_POST["actorId"]);

			if (!empty($headline) && !empty($actor)) {

				$relation = HeadlineActorQuery::create()->filterByHeadline($headline)->filterByActor($actor)->findOne();
				if (!empty($relation))
					try {
						$relation->delete();
						$smarty->assign('actor',$actor);
						return $mapping->findForwardConfig('success');
					}
					catch (PropelException $exp) {
						if (ConfigModule::get("global","showPropelExceptions"))
							print_r($exp->getMessage());
				}
			}
		}

		$smarty->assign('errorTagId','categoryMsgField');
		return $mapping->findForwardConfig('failure');
	}

}

