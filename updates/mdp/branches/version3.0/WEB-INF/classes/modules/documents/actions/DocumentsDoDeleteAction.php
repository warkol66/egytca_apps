<?php

require_once 'import/ActionPrefixGetter.php';

/**
* DocumentsDoDeleteAction
*
*  Action que genera un cambio de estado en la base de datos, se le manda el nombre de una categoria
*  y lo busca en dicha base de datos y finalmente lo elimina.
*
*/

class DocumentsDoDeleteAction extends BaseAction {

	function DocumentsDoDeleteAction() {
		;
	}
	
	function redirectTo($url) {
		return header('Location: '.$url);
	}
	
	function addParams($params, $url) {
		$urlWithParams = $url;
		foreach ($params as $param => $value) {
			$urlWithParams .= '&'.$param.'='.$value;
		}
		return $urlWithParams;
	}
	
	function generateDynamicForward($forwardName, $params) {
		
		switch ($forwardName) {
			case 'success':
				$actionPrefix = ActionPrefixGetter::scan(
					$_SERVER['HTTP_REFERER'], 'Edit');
				return new ForwardConfig($this->addParams($params,
					'Main.php?do='.$actionPrefix.'Edit'), True);
			case 'failure':
				$actionPrefix = ActionPrefixGetter::scan(
					$_SERVER['HTTP_REFERER'], 'Edit');
				return new ForwardConfig($this->addParams($params,
					'Main.php?do='.$actionPrefix.'Edit'), True);
			default:
				throw new Exception('invalid argument "'.$forwardName
					.'" for '.$forwardName);
		}
	}
	
	function findEntityForwardConfig($forwardName, $params, $mapping) {
		
		$fconf = $mapping->findForwardConfig($forwardName);
		if (!is_null($fconf))
			return $this->addParamsToForwards($params, $mapping, $forwardName . $_POST['entity']);
		else
			return $this->generateDynamicForward($forwardName, $params);
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

		$documentPeer = new DocumentPeer();

		////////////
		// se obtiene el archivo a eliminar
		$id = $_POST["id"];
		$document = $documentPeer->getById($id);
		$password = $_POST['password'];

		//validacion de password
		if (!$document->checkPassword($password))
			return $this->findEntityForwardConfig('failure', array('id'=>$_POST['entityId'],'errormessage'=>'wrongPasswordComparison'), $mapping);
		else {
			if (!empty($_POST['entity'])) {
				$queryClassName = $_POST['entity'] . 'DocumentQuery';
				if (class_exists($queryClassName)) {
					$methodName = 'findOneByDocumentIdAnd' . $_POST['entity'] . 'Id';
					try{
						$queryInstance = new $queryClassName;
						$queryInstance->$methodName($_POST["id"], $_POST['entityId'])->delete();
					} catch(Exception $e) {
						return $this->findEntityForwardConfig('failure', array('id'=>$_POST['entityId'],'errormessage'=>'errorFound'), $mapping);
					}

					//si el documento no tiene mas referencias cruzadas lo elimino.
					$queryInstance = new $queryClassName;
					if ($queryInstance->filterByDocumentId($_POST["id"])->count() <= 0) {
						if (!$documentPeer->delete($_POST["id"]))
							return $this->findEntityForwardConfig('failure', array('id'=>$_POST['entityId'],'errormessage'=>'errorFound'), $mapping);
					}
				}
			}
			else {
				if (!$documentPeer->delete($_POST["id"])) {
					$smarty->assign("errormessage", "errorFound");
					return $mapping->findForwardConfig("failure");
				}
			}

		}
		return $this->findEntityForwardConfig('success', array('id'=>$_POST['entityId'],'message'=>'deletesuccess'), $mapping);

	}

}
