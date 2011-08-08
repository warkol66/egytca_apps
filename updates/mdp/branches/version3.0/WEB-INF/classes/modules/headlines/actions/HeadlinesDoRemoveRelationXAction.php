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
			$relation = HeadlineQuery::create()->findPk($_POST["relationId"]);

			if (!empty($headline) && !empty($relation)) {

				$filtered = HeadlineRelationQuery::create()->filterByHeadlineRelatedByHeadlinefromid($headline)
                                        ->filterByHeadlineRelatedByHeadlinetoid($relation)->findOne();
				if (!empty($filtered))
					try {
						$filtered->delete();
						$smarty->assign('relation',$relation);
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

