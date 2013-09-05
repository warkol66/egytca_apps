<?php

class TwitterParsedSaveXAction extends BaseAction {

	function TwitterParsedSaveXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Twitter";
		$smarty->assign("module",$module);

		if (!empty($_GET["id"])) {
			$tweetParsed = TwitterTweetQuery::create()->findOneById($_GET["id"]);
			if (!is_null($tweetParsed)) {
				try {
					$tweetParsed->accept();
				} catch (Exception $e) {
					return $mapping->findForwardConfig('failure');
				}
				
				$smarty->assign("tweet",$tweetParsed);
				return $mapping->findForwardConfig('success');
			}
		}
		return $mapping->findForwardConfig('failure');
	}
}
