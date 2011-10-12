<?php

require_once 'import/ActionPrefixGetter.php';

/**
* DocumentsDoEditAction
*
*  Action que genera un cambio de estado en la base de datos, le llegan datos de
*  un documento y los actualiza en dicha base de datos.
* 
* @package documents
*/

class DocumentsDoEditAction extends BaseAction {

	function DocumentsDoEditAction() {
		;
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
			case 'failureUpload':
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
	
	function failureSmartySetup($smarty,$document) {
		
		require_once('CategoryPeer.php');
		
		//obtengo las categorias que el usuario puede acceder	
		$user = Common::getAdminLogged();
		$smarty->assign('user',$user);
		$categories = $user->getDocumentsParentCategories();
		$smarty->assign("categories",$categories);
		
		$smarty->assign('document',$document);
		
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

		$documentPeer = new DocumentPeer();
		
		//caso de edicion
		if ($_POST['id']) {
		
			$id = $_POST["id"];
			$document = $documentPeer->getById($id);

			$password = $_POST["old_password"];
			
			//validacion de password
			if (!$document->checkPassword($password)) {

				$this->failureSmartySetup($smarty,$document);
				$smarty->assign('message','wrongPassword');
				return $mapping->findForwardConfig('failure');
			}
			
			//validamos el nuevo password y su verificacion
			if($_POST["password"]!=$_POST["password_compare"]) {
				$this->failureSmartySetup($smarty,$document);
				$smarty->assign('message','wrongPasswordComparison');
				return $mapping->findForwardConfig('failure');
			}

			if (!$_FILES["document_file"]['name'] == '') 
				$documentPeer->updateDocument($_POST["id"],$_POST['title'],$_POST["description"],$_POST["date"],$_POST["category"],$_POST["password"],$_POST["extra"],$_FILES["document_file"]);
			else 
				$documentPeer->updateDocument($_POST["id"],$_POST['title'],$_POST["description"],$_POST["date"],$_POST["category"],$_POST["password"],$_POST["extra"]);

			return $this->findEntityForwardConfig('success', array('id'=>$_POST['entityId'],'message'=>'uploadsuccess'), $mapping);

		}
		else {
			//caso de upload o creacion de nuevo documento
			
			//si no llega ningun archivo significa que la carga se realizo por swfUpload.
			if(empty($_FILES["document_file"]['name'])) {
				return $this->findEntityForwardConfig('success', array('id'=>$_POST['entityId'],'message'=>'uploadsuccess'), $mapping);
			}

			if($_POST["password"]!=$_POST["password_compare"]){
				$this->failureSmartySetup($smarty,$document);
				$smarty->assign('message','wrongPasswordComparison');
				return $mapping->findForwardConfig('failure');
			}		
			////////////
			// se inserta en la base de datos todo lo ingresado en el formulario anterior y la fecha
			$document = $documentPeer->create($_FILES["document_file"],$_POST['title'],$_POST["description"],$_POST['date'],$_POST["category"],$_POST["password"],$_POST["extra"]);
			
			// Si no le tenemos que asociar ninguna entidad terminamos la accion acá
			if (empty($_POST['entity'])) {
				return $mapping->findForwardConfig('success');
			}
			
			$addMethod = 'add' . $_POST['entity'];
			if ( method_exists($document, $addMethod) && !empty($_POST['entityId'])) {
				$queryClass = $_POST['entity'] . 'Query';
				if ( class_exists($queryClass) ) {
					$queryInstance = new $queryClass;
					$entity = $queryInstance->findPK($_POST['entityId']);
					$document->$addMethod($entity);
					$document->save();
					return $this->findEntityForwardConfig('success', array('id'=>$_POST['entityId'],'message'=>'uploadsuccess'), $mapping);
				}
			} else {
				/*reviso si está en nueva tabla.
				si está hago lo mismo de arriba.
				si no está salgo del else y devuelvo error.*/
			}
			return $this->findEntityForwardConfig('failureUpload', array('id'=>$_POST['entityId'],'errormessage'=>'documentUploadError'), $mapping);
		}

	}

}
