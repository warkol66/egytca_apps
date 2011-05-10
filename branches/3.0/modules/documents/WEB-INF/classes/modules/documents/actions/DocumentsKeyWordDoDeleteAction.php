<?php
/**
* DocumentsKeyWordDoDeleteAction
*
*  Action que genera un cambio de estado en la base de datos, se le manda el nombre de una categoria
*  y lo busca en dicha base de datos y finalmente lo elimina.
* 
*/

require_once("BaseAction.php");
require_once("DocumentKeyWordPeer.php");

class DocumentsKeyWordDoDeleteAction extends BaseAction {

	function DocumentsKeyWordDoDeleteAction() {
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

		$keyWordPeer = new DocumentKeyWordPeer();

		$id = $_POST["id"];
		$keyWordObj = $keyWordPeer->get($id);

		if (!$keyWordPeer->delete($_POST["id"]))
			return $mapping->findForwardConfig('failure');
		
		return $mapping->findForwardConfig('success');

	}

}
