<?php

class HeadlinesParsedSaveXAction extends BaseAction {

	function HeadlinesParsedSaveXAction() {
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
		$smarty->assign("module",$module);

		if (!empty($_GET["id"])) {
			$headline = HeadlineParsedQuery::create()->findOneById($_GET["id"]);
			if (!is_null($headline)) {
				$newHeadline = new Headline();
				Common::morphObject($headline,$newHeadline);
				
				if($newHeadline->isModified() && $newHeadline->save()) {

					$headline->setStatus(HeadlineParsedQuery::STATUS_PROCESSED);
					if($headline->isModified() && $headline->save()){
					}
					$smarty->assign("headline",$newHeadline);
					return $mapping->findForwardConfig('success');
				}
			}
		}
		return $mapping->findForwardConfig('failure');
	}
}
