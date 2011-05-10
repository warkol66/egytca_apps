<?php

require_once("BaseAction.php");

class CommonGenerateJsAction extends BaseAction {

	function CommonGenerateJsAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);
  	/**
   	* Use a different template
   	*/
		$this->template->template = "TemplatePlain.tpl";
		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$modulePath = "WEB-INF/classes/modules/";
		$fileName = ucfirst($_GET["module"]) . ucfirst($_GET["section"]) ."Js";
		if (!empty($_GET["module"])) {
			$jsFile = $modulePath . $_GET["module"] . "/tpl/" .$fileName . ".js";
			$jsTemplate = file_get_contents($jsFile);
		}

		$timezonePeer = new TimezonePeer();
		$timestamp = $timezonePeer->getServerTimeOnGMT0();

		$languages = Common::getAllLanguages();

		foreach ($languages as $language) { 
			$jsResult = $smarty->fetch($jsTemplate);
			rename("scripts/" . $fileName . "_" . $language->getCode() . ".js", "scripts/" . $jsFile . "_" . $language->getCode() . date('Ymd_His') . ".js");
			file_put_contents("scripts/" . $fileName . "_" . $language->getCode() . ".js", $jsResult); 
		}

		return $mapping->findForwardConfig('success');

	}

}

