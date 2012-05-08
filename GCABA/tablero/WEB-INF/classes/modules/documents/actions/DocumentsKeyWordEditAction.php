<?php

/**
* DocumentsKeyWordEditAction
*
* Action que permite ver los datos correspondientes de un documento que pueden modificarse
*
* @package documents
*/

class DocumentsKeyWordEditAction extends BaseAction {

	function DocumentsKeyWordEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);


		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Documents";
		$smarty->assign("module",$module);
		$section = "KeyWords";
		$smarty->assign("section",$section);

		//caso de edicion de un keyword
		if (isset($_REQUEST['id'])) {
			$keyWordPeer= new DocumentKeyWordPeer();
			$keyWord = $keyWordPeer->get($_REQUEST["id"]);
			$smarty->assign("keyWord",$keyWord);
		}

		return $mapping->findForwardConfig('success');

	}

}
