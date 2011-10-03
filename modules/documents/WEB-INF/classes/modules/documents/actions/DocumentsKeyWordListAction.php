<?php
/**
* DocumentsKeyWordsListAction
*
*  Action administrativo utilizado para mostrar los documentos existentes
* 
* @package documents
*/

class DocumentsKeyWordListAction extends BaseAction {

	function DocumentsKeyWordListAction() {
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

		$keyWords = DocumentKeyWordPeer::getAll();
		$smarty->assign('keyWords',$keyWords);

		return $mapping->findForwardConfig('success');

	}

}
