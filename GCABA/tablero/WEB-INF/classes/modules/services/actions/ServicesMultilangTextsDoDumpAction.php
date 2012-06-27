<?php

class ServicesMultilangTextsDoDumpAction extends BaseAction {

	function ServicesMultilangTextsDoDumpAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

   	BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		if (isset($_GET["moduleName"]) && isset($_GET["languageCode"])) {

			$this->template->template = "TemplatePlain.tpl";

			$dump = MultilangTextPeer::getSQLCleanup($_GET["moduleName"],$_GET["languageCode"])."\n";				
			$allMultilangText = MultilangTextPeer::getAllByModuleAndLanguage($_GET["moduleName"],$_GET["languageCode"]);
	
			foreach ($allMultilangText as $multilangText)
				$dump .= $multilangText->getSQLInsert()."\n";

			header("content-disposition: attachment; filename=multilangText_".$_GET["languageCode"].".sql");
			header("Content-type: text/sql; charset=UTF-8");

    	$smarty->assign("dump",$dump);
			return $mapping->findForwardConfig('success');
    
		}

   	$smarty->assign("message","No valid parameters");
   	$smarty->assign("url","Main.php?do=servicesMultilangTextsDump");
		return $mapping->findForwardConfig('failure');
	}

}
