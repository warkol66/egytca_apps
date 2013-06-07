<?php
/**
* DocumentsDoDeleteXAction
*
*  Action que genera un cambio de estado en la base de datos, se le manda el nombre de una categoria
*  y lo busca en dicha base de datos y finalmente lo elimina.
*
*/

class DocumentsDoDeleteXAction extends BaseAction {

	function DocumentsDoDeleteXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Documentos";
		$smarty->assign("module",$module);
		
		////////////
		// se obtiene el archivo a eliminar
		$id = $_POST["id"];
		$smarty->assign("id", $id);
		$document = DocumentQuery::create()->findOneById($id);
		$password = $_POST['password'];
		
		if(isset($_POST['objectId']))
			$smarty->assign("objectId", $_POST['objectId']);

		//validacion de password
		if (!$document->checkPasswordValidation($password)) {
			$smarty->assign("errormessage", "wrongPasswordComparison");
			return $mapping->findForwardConfig("failure");
		}
		else {
			if (!empty($_POST['entity'])) {
				$queryClassName = $_POST['entity'] . 'DocumentQuery';
				if (class_exists($queryClassName)) {
					$methodName = 'findOneByDocumentIdAnd' . $_POST['entity'] . 'Id';
					try{
						$queryInstance = new $queryClassName;
						$queryInstance->$methodName($_POST["id"], $_POST['entityId'])->delete();
					} catch(Exception $e) {
						$smarty->assign("errormessage", "errorFound");
						return $mapping->findForwardConfig("failure");
					}

					//si el documento no tiene mas referencias cruzadas lo elimino.
					$queryInstance = new $queryClassName;
					if ($queryInstance->filterByDocumentId($_POST["id"])->count() <= 0) {
						if (!Document::deleteUnlink($_POST["id"])) {
							$smarty->assign("errormessage", "errorFound");
							return $mapping->findForwardConfig("failure");
						}
					}
				}
			}
			else {
				if (!Document::deleteUnlink($_POST["id"])) {
					//print_r(Document::deleteUnlink($_POST["id"]));
					//echo(Document::deleteUnlink($_POST["id"]));
					//die();
					$smarty->assign("errormessage", "errorFound");
					return $mapping->findForwardConfig("failure");
				}
			}
		}
		$smarty->assign("message", "deleteSuccess");
		return $mapping->findForwardConfig("success");
	}

}
