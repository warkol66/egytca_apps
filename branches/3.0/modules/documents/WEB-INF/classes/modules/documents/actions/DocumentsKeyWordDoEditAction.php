<?php
/**
* DocumentsKeyWordDoEditAction
*
*  Action que genera un cambio de estado en la base de datos, le llegan datos de
*  un documento y los actualiza  en dicha base de datos.
*
* @package documents
*/

class DocumentsKeyWordDoEditAction extends BaseAction {

	function DocumentsKeyWordDoEditAction() {
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

		$keyWordPeer= new DocumentKeyWordPeer();

		if ($_POST['id']) {
			$keyWord = $keyWordPeer->get($_POST["id"]);
			$keyWordPeer->update($_POST["id"],$_POST['keyWord']);
			return $mapping->findForwardConfig('success');
		}
		else {
			$keyWordPeer->create($_POST['keyWord']);
			return $mapping->findForwardConfig('success');
		}

	}

}
