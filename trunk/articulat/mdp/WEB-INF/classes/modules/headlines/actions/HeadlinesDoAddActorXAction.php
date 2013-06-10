<?php
class HeadlinesDoAddActorXAction extends BaseAction {

	function HeadlinesDoAddActorXAction() {
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
		
		$headline = HeadlineQuery::create()->findPk($_POST['headlineId']);
		$actor = ActorQuery::create()->findPk($_POST['actor']['id']);;

		if (!empty($headline) && !empty($actor)) {
			if (!$headline->hasActor($actor)) {
				$headline->addActor($actor);
				if (!$headline->save()) {
					$smarty->assign('message', 'failure');
					return $mapping->findForwardConfig('success');
				} 
			}
		}
		else {
			$smarty->assign('message', 'failure');
			return $mapping->findForwardConfig('success');
		}

		$smarty->assign('headline', $headline);
		$smarty->assign('actor', $actor);
		$smarty->assign('message', 'success');

		return $mapping->findForwardConfig('success');
	}
}
