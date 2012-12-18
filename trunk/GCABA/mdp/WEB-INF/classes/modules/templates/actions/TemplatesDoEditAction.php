<?php
/**
* TemplatesDoEditAction
*
*  Action que genera un cambio de estado en la base de datos, le llegan datos de
*  un documento y los actualiza en dicha base de datos.
* 
* @package templates
*/

class TemplatesDoEditAction extends BaseDoEditAction {

	function __construct() {
		parent::__construct('Template');
	}
	
	protected function preUpdate(){
		parent::preUpdate();
		
		//caso edit
		if ($_POST['id']) {
			
			$id = $_POST["id"];
			$document = TemplateQuery::create()->findOneById($_POST["id"]);
			$password = $_POST["old_password"];
			
			//validacion de password
			if (!$document->checkPassword($password)) {

				$this->failureSmartySetup($smarty,$document);
				$this->smarty->assign('message','wrongPassword');
				return false;
			}
			
			//validamos el nuevo password y su verificacion
			if($_POST["password"]!=$_POST["password_compare"]) {
				$this->failureSmartySetup($smarty,$document);
				$this->smarty->assign('message','wrongPasswordComparison');
				return false;
			}
			
		}else{
			
			if($_POST["password"]!=$_POST["password_compare"]){
				$this->failureSmartySetup($smarty,$document);
				$this->smarty->assign('message','wrongPasswordComparison');
				return false;
			}
		}
		
		//seteo nombre y size
		if (!$_FILES["document_file"]['name'] == ''){
			$this->entityParams['realFilename'] = $_FILES["document_file"]['name'];
			$this->entityParams['size'] = $_FILES["document_file"]['size'];
		}
		
		$this->entityParams['date'] = new DateTime();
		
	}
	
	protected function postUpdate(){
		parent::postUpdate();
		
		$module = "Templates";
		$this->smarty->assign("module",$module);
		
		$moduleConfig = Common::getModuleConfiguration('templates');
		//$documentsPath = $moduleConfig['templatesPath'];
		$documentsPath = 'WEB-INF/';
		
		if (move_uploaded_file($_FILES["document_file"]['tmp_name'], $documentsPath . $this->entity->getId())){
			//Ver que hacer si no se guarda
		}
		
	}

}
	
/*
	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);


		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Templates";
		$smarty->assign("module",$module);

		$templatePeer = new TemplatePeer();
		
		//caso de edicion
		if ($_POST['id']) {
		
			$id = $_POST["id"];
			$template = $templatePeer->getById($id);

			$password = $_POST["old_password"];
			
			//validacion de password
			if (!$template->checkPassword($password)) {

				$this->failureSmartySetup($smarty,$template);
				$smarty->assign('message','wrongPassword');
				return $mapping->findForwardConfig('failure');
			}
			
			//validamos el nuevo password y su verificacion
			if($_POST["password"]!=$_POST["password_compare"]) {
				$this->failureSmartySetup($smarty,$template);
				$smarty->assign('message','wrongPasswordComparison');
				return $mapping->findForwardConfig('failure');
			}

			if (!$_FILES["document_file"]['name'] == '') 
				$templatePeer->updateTemplate($_POST["id"],$_POST['title'],$_POST["description"],$_POST["date"],$_POST["category"],$_POST["password"],$_POST["extra"],$_FILES["document_file"]);
			else 
				$templatePeer->updateTemplate($_POST["id"],$_POST['title'],$_POST["description"],$_POST["date"],$_POST["category"],$_POST["password"],$_POST["extra"]);

			return $this->findEntityForwardConfig('success', array('message'=>'uploadsuccess'), $mapping);

		}
		else {
			//caso de upload o creacion de nuevo documento
			
			//si no existe el directorio de documentos se lo crea.
			$moduleConfig = Common::getModuleConfiguration('templates');
			$templatesPath = $moduleConfig['templatesPath'];
			if (!file_exists($templatesPath))
				if(!mkdir($templatesPath))
					throw new Exception("no se pudo crear directorio de documentos");
			
			//si no llega ningun archivo significa que la carga se realizo por swfUpload.
			if(empty($_FILES["document_file"]['name'])) {
				return $this->findEntityForwardConfig('success', array('message'=>'uploadsuccess'), $mapping);
			}

			if($_POST["password"]!=$_POST["password_compare"]){
				$this->failureSmartySetup($smarty,$template);
				$smarty->assign('message','wrongPasswordComparison');
				return $mapping->findForwardConfig('failure');
			}		
			////////////
			// se inserta en la base de datos todo lo ingresado en el formulario anterior y la fecha
			$template = $templatePeer->create($_FILES["document_file"],$_POST['title'],$_POST["description"],$_POST['date'],$_POST["category"],$_POST["password"],$_POST["extra"]);
			if ($template === false)
				return $this->findEntityForwardConfig('failure', array('errormessage'=>'documentUploadError'), $mapping);
			
			// Si no le tenemos que asociar ninguna entidad terminamos la accion acá
			if (empty($_POST['entity'])) {
				return $mapping->findForwardConfig('success');
			}
			
			$addMethod = 'add' . $_POST['entity'];
			if ( method_exists($template, $addMethod) && !empty($_POST['entityId'])) {
				$queryClass = $_POST['entity'] . 'Query';
				if ( class_exists($queryClass) ) {
					$queryInstance = new $queryClass;
					$entity = $queryInstance->findPK($_POST['entityId']);
					$template->$addMethod($entity);
					$template->save();
					return $this->findEntityForwardConfig('success', array('message'=>'uploadsuccess'), $mapping);
				}
			} else {
				if (!empty($_POST['entityId'])) {
					$relatedEntity = new TemplateRelatedEntity();
					$relatedEntity->setEntityid($_POST['entityId']);
					$relatedEntity->setEntitytype($_POST['entity']);
					$relatedEntity->setTemplateid($template->getId());
					
					$template->addTemplateRelatedEntity($relatedEntity);
					$template->save();
					return $this->findEntityForwardConfig('success', array('message'=>'uploadsuccess'), $mapping);
				}
			}
			return $this->findEntityForwardConfig('failure', array('errormessage'=>'documentUploadError'), $mapping);
		}

	}

}
*/
