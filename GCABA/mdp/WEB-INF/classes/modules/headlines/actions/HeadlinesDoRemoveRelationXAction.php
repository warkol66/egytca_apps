<?php

class HeadlinesDoRemoveRelationXAction extends BaseAction {

	function HeadlinesDoRemoveRelationXAction() {
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

		if (!empty($_POST["headlineId"]) && !(empty($_POST["relationId"]))) {

			$headline = HeadlineQuery::create()->findPk($_POST["headlineId"]);
			$related = HeadlineQuery::create()->findPk($_POST["relationId"]);

			if (!empty($headline) && !empty($related)) {

				$relation = HeadlineRelationQuery::create()->filterByHeadline1($headline)
																									 ->filterByHeadline2($related)
																									 ->findOne();
				if (!empty($relation))
					try {
						$relation->delete();
						$smarty->assign('related',$related);
						return $mapping->findForwardConfig('success');
					}
					catch (PropelException $exp) {
						if (ConfigModule::get("global","showPropelExceptions"))
							print_r($exp->getMessage());
				}
			}
		}

		$smarty->assign('errorTagId','msgField');
		return $mapping->findForwardConfig('failure');
	}

}

