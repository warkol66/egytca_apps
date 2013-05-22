<?php
/**
* DocumentsDoDeleteAction
*
*  Action que genera un cambio de estado en la base de datos, se le manda el nombre de una categoria
*  y lo busca en dicha base de datos y finalmente lo elimina.
*
*/

/*class DocumentsDoDeleteAction extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('Document');
		
	}
	
	protected function preDelete(){
		
		// se obtiene el archivo a eliminar
		$id = $_POST["id"];
		$document = DocumentQuery::create()->findOneById($id);
		$password = $_POST['password'];
		
		//si no valida el password no hago nada
		if (!$document->checkPasswordValidation($password)){
			$this->forwardFailureName = 'success';
			return false;
			//return $this->addParamsToForwards(array('id'=>$_POST['entityId'],'errormessage'=>'wrongPasswordComparison'), $mapping, 'failure' . $_POST['entity']);
		}
		
	}
	
	protected function postDelete(){
		parent::postDelete();
		
		$module = "Documentos";
		$this->smarty->assign("module",$module);
		
	}

}*/

class DocumentsDoDeleteAction extends BaseAction {

	function DocumentsDoDeleteAction() {
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
		$document = DocumentQuery::create()->findOneById($id);
		$password = $_POST['password'];

		//validacion de password
		if (!$document->checkPasswordValidation($password))
			return $this->addParamsToForwards(array('id'=>$_POST['entityId'],'errormessage'=>'wrongPasswordComparison'), $mapping, 'failure' . $_POST['entity']);
		else {
			if (!empty($_POST['entity'])) {
				$queryClassName = $_POST['entity'] . 'DocumentQuery';
				if (class_exists($queryClassName)) {
					$methodName = 'findOneByDocumentIdAnd' . $_POST['entity'] . 'Id';
					try{
						$queryInstance = new $queryClassName;
						$queryInstance->$methodName($_POST["id"], $_POST['entityId'])->delete();
					} catch(Exception $e) {
						return $this->addParamsToForwards(array('id'=>$_POST['entityId'],'errormessage'=>'errorFound'), $mapping, 'failure' . $_POST['entity']);
					}

					//si el documento no tiene mas referencias cruzadas lo elimino.
					$queryInstance = new $queryClassName;
					if ($queryInstance->filterByDocumentId($_POST["id"])->count() <= 0) {
						if (!Document::deleteUnlink($_POST["id"]))
							return $this->addParamsToForwards(array('id'=>$_POST['entityId'],'errormessage'=>'errorFound'), $mapping, 'failure' . $_POST['entity']);
					}
				}
			}
			else {
				if (!Document::deleteUnlink($_POST["id"])) {
					$smarty->assign("errormessage", "errorFound");
					return $mapping->findForwardConfig("failure");
				}
			}

		}
		return $this->addParamsToForwards(array('id'=>$_POST['entityId'],'message'=>'deletesuccess'), $mapping, 'success' . $_POST['entity']);

	}

}
