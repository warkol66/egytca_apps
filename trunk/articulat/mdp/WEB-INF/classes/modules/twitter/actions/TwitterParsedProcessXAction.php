<?php

class TwitterParsedProcessXAction extends BaseAction {

	function TwitterParsedProcessXAction() {
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
		$processAction = $_REQUEST["action"];
		
		if (!empty($_GET["id"])) {

			//si tengo que procesar mas de un tweet
			if (!empty($_POST["tweetsIds"])){
				try {
					if($processAction == 'save'){
						TwitterTweet::acceptMultiple($_POST["tweetsIds"]);
					}elseif($processAction == 'discard')
						TwitterTweet::discardMultiple($_POST["tweetsIds"]);
				} catch (Exception $e) {
					$smarty->assign("error",'true');
					return $mapping->findForwardConfig('success');
				}
				
				$smarty->assign("processAction",$processAction);
				$smarty->assign("multiple",'true');
				$smarty->assign("tweets",$_POST["tweetsIds"]);
				return $mapping->findForwardConfig('success');

			}else{	
				$tweetParsed = TwitterTweetQuery::create()->findOneById($_GET["id"]);
				if (!is_null($tweetParsed)) {
					try {
						if($processAction == 'save')
							$tweetParsed->accept();
						elseif($processAction == 'discard')
							$tweetParsed->discard();
					} catch (Exception $e) {
						$smarty->assign("error",'true');
						return $mapping->findForwardConfig('success');
					}
					
					$smarty->assign("processAction",$processAction);
					$smarty->assign("tweet",$tweetParsed);
					return $mapping->findForwardConfig('success');
				}
			}
		}
		$smarty->assign("error",'true');
		return $mapping->findForwardConfig('success');
	}
}