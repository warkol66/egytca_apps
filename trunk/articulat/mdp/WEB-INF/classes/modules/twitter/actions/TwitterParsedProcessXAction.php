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
					switch($processAction){
						case 'save':
							TwitterTweet::editMultiple('Status', TwitterTweet::ACCEPTED, $_POST["tweetsIds"]);
							$info = 'Aceptados';
						break;
						case 'discard':
							TwitterTweet::editMultiple('Status', TwitterTweet::DISCARDED, $_POST["tweetsIds"]);
							$info = 'Descartados';
						break;
						case 'positive':
							TwitterTweet::editMultiple('Value', TwitterTweet::POSITIVE, $_POST["tweetsIds"]);
							TwitterTweet::editMultiple('Status', TwitterTweet::ACCEPTED, $_POST["tweetsIds"]);
							$info = 'Valorados como positivos';
						break;
						case 'neutral':
							TwitterTweet::editMultiple('Value', TwitterTweet::NEUTRAL, $_POST["tweetsIds"]);
							TwitterTweet::editMultiple('Status', TwitterTweet::ACCEPTED, $_POST["tweetsIds"]);
							$info = 'Valorados como neutrales';
						break;
						case 'negative':
							TwitterTweet::editMultiple('Value', TwitterTweet::NEGATIVE, $_POST["tweetsIds"]);
							TwitterTweet::editMultiple('Status', TwitterTweet::ACCEPTED, $_POST["tweetsIds"]);
							$info = 'Valorados como negativos';
						break;
					}
				} catch (Exception $e) {
					$smarty->assign("error",'true');
					return $mapping->findForwardConfig('success');
				}
				
				$smarty->assign("processAction",$processAction);
				$smarty->assign("infoMessage",$info);
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
