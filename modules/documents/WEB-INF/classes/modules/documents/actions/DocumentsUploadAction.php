<?php

require_once("DocumentsBaseAction.php");
require_once("BaseAction.php");

class DocumentsUploadAction extends DocumentsBaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function DocumentsUploadAction() {
		;
	}


	// ----- Public Methods ------------------------------------------------- //

	/**
	* Process the specified HTTP request, and create the corresponding HTTP
	* response (or forward to another web component that will create it).
	* Return an <code>ActionForward</code> instance describing where and how
	* control should be forwarded, or <code>NULL</code> if the response has
	* already been completed.
	*
	* @param ActionConfig		The ActionConfig (mapping) used to select this instance
	* @param ActionForm			The optional ActionForm bean for this request (if any)
	* @param HttpRequestBase	The HTTP request we are processing
	* @param HttpRequestBase	The HTTP response we are creating
	* @public
	* @returns ActionForward
	*/
	function execute($mapping, $form, &$request, &$response) {

    	BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
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
				if (!$this->documentPasswordValidation($document,$password)) {

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
				if (empty($_POST['entity'])) {
					return $mapping->findForwardConfig('success');
				}
				
				$addMethod = 'add' . $_POST['entity'];
				if ( method_exists($document, $addMethod) && !empty($_POST['entityId'])) {
					$queryClass = $_POST['entity'] . 'Query';
					if ( class_exists($queryClass) ) {
						$queryInstance = new $queryClass;
						$project = $queryInstance->findPK($_POST['entityId']);
						$document->$addMethod($project);
						$document->save();
						$smarty->assign('message', 'Operación exitosa');
						$smarty->assign('entity', $_POST['entity']);
						$smarty->assign('entityId', $_POST['entityId']);
						$smarty->assign('document', $document);
						return $mapping->findForwardConfig('success');
					}
				}
				$smarty->assign('message','Error al intentar vincular el documento con la entidad');
				return $mapping->findForwardConfig('failure');
			}
		}
		$smarty->assign('message','Error, se esperaba un archivo');
		return $mapping->findForwardConfig('failure');
	}

}