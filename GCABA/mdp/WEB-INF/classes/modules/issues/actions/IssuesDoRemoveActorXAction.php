<?php

class IssuesDoRemoveActorXAction extends BaseAction {

	function IssuesDoRemoveActorXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Issues";

		if (!empty($_POST["issueId"]) && !(empty($_POST["actorId"]))) {
		
			$issue = IssueQuery::create()->findPk($_POST["issueId"]);
			$actor = ActorQuery::create()->findPk($_POST["actorId"]);

			if (!empty($issue) && !empty($actor)) {

				$relation = IssueActorQuery::create()->filterByIssue($issue)->filterByActor($actor)->findOne();
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

