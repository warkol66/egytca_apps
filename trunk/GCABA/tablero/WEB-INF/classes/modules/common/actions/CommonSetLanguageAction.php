<?php
/**
 * CommonSetLanguageAction
 *
 * @package common
 */

require_once("BaseAction.php");

class CommonSetLanguageAction extends BaseAction {

	function CommonSetLanguageAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$languageCode = MultilangLanguagePeer::getByCode($_GET["languageCode"]);

		if (!empty($languageCode))
			Common::setCurrentLanguageCode($languageCode);

		$referrer = $_SERVER['HTTP_REFERER'];
		if ($referrer != '') {
			header("Location: ".$referrer);
			exit;
		}
		else{
			header("Location: Main.php");
			exit;
		}
	}

}
