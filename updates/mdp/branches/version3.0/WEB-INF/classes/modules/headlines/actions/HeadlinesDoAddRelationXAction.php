<?php
class HeadlinesDoAddRelationXAction extends BaseAction {

	function HeadlinesDoAddRelationXAction() {
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
		$relation = HeadlineQuery::create()->findPk($_POST['relation']['id']);

		if (!empty($headline) && !empty($relation)) {
			if (!$headline->hasHeadline($relation)) {
				$headline->addHeadlineRelatedByHeadlinetoid($relation);
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
		$smarty->assign('headlineId', $headline->getId());
		$smarty->assign('relation', $relation);
		$smarty->assign('message', 'success');
		return $mapping->findForwardConfig('success');
	}
}
