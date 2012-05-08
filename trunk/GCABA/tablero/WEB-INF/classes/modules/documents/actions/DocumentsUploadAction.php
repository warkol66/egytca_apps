<?php

class DocumentsUploadAction extends BaseAction {

	function DocumentsUploadAction() {
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

		$this->template->template = 'TemplateAjax.tpl';

		if (isset($_FILES["document_file"]) && is_uploaded_file($_FILES["document_file"]["tmp_name"]) && $_FILES["document_file"]["error"] == 0) {
			$documentPeer = new DocumentPeer();

			//caso de edicion
			if ($_POST['id']) {

				$id = $_POST["id"];
				$document = $documentPeer->getById($id);

				$password = $_POST["old_password"];

				//validacion de password
				if (!$document->checkPasswordValidation($password)) {

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
				$documentPeer->updateDocument($_POST["id"],$_POST['title'],$_POST["description"],$_POST["date"],$_POST["category"],$_POST["password"],$_POST["extra"],$_FILES["document_file"]);
				return $mapping->findForwardConfig('success');
			}
			else {
				//caso de upload o creacion de nuevo documento

				if($_POST["password"]!=$_POST["password_compare"]){
					$smarty->assign('message','wrongPasswordComparison');
					return $mapping->findForwardConfig('failure');
				}
				////////////
				// se inserta en la base de datos todo lo ingresado en el formulario anterior y la fecha
				$document = $documentPeer->create($_FILES["document_file"],$_POST['title'],$_POST["description"],$_POST['date'],$_POST["category"],$_POST["password"],$_POST["extra"]);

				// Si no le tenemos que asociar ninguna entidad terminamos la accion acá
				if (empty($_POST['entity']))
					return $mapping->findForwardConfig('success');

				$addMethod = 'add' . $_POST['entity'];
				if ( method_exists($document, $addMethod) && !empty($_POST['entityId'])) {
					$queryClass = $_POST['entity'] . 'Query';
					if ( class_exists($queryClass) ) {
						$queryInstance = new $queryClass;
						$project = $queryInstance->findPK($_POST['entityId']);
						$document->$addMethod($project);
						$document->save();
						$smarty->assign('message', 'successUpload');
						$smarty->assign('entity', $_POST['entity']);
						$smarty->assign('entityId', $_POST['entityId']);
						$smarty->assign('document', $document);
						return $mapping->findForwardConfig('success');
					}
				}
				$smarty->assign('message','errorRelation');
				return $mapping->findForwardConfig('failure');
			}
		}
		$smarty->assign('message','errorFile');
		return $mapping->findForwardConfig('failure');
	}

}
