<?php

class MultilangTextsDoEditAction extends BaseAction {

	function MultilangTextsDoEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$modulo = "Multilang";

		if ( $_POST["action"] == "edit" ) {
			foreach ($_POST["text"] as $languageCode => $text)
				MultilangTextPeer::update($_POST["id"],$_POST["moduleName"],$languageCode,$text);
		}
		else {
			$i=0;
			foreach ($_POST["text"] as $languageCode => $text) {
				if ($i==0)
					$id = MultilangTextPeer::create($_POST["moduleName"],$languageCode,$text);
				else
					MultilangTextPeer::createWithId($id,$_POST["moduleName"],$languageCode,$text);
				$i++;
			}
		}

		header("Location: Main.php?do=multilangTextsList&moduleName=".$_POST["moduleName"]."&page=".$_POST["currentPage"]);
		exit;

		return $mapping->findForwardConfig('success');
	}

}
