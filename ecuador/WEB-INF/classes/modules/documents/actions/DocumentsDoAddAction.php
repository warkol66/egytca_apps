<?php
/**
* DocumentsDoEditAction
*
*  Action que genera un cambio de estado en la base de datos, le llegan datos de
*  un documento y los actualiza en dicha base de datos.
* 
* @package documents
*/

class DocumentsDoAddAction extends BaseDoEditAction {
	
	public function __construct() {
		parent::__construct('Document');
	}
	
	function failureSmartySetup() {
		
		//obtengo las categorias que el usuario puede acceder	
		$user = Common::getAdminLogged();
		$this->smarty->assign('user', $user);
		$categories = $user->getDocumentsParentCategories();
		$this->smarty->assign('categories', $categories);
		
		$this->smarty->assign('document', $this->entity);
	}	
	
	protected function preUpdate() {
		parent::preUpdate();
		
		$this->template->template = 'TemplateAjax.tpl';
		
		if(isset($_POST['module']))
			$this->smarty->assign('module', $_POST['module']);
		
		//validacion de password
		if ($this->entity->isPasswordProtected() && !$this->entity->checkPassword($_POST['old_password'])) {
			$this->failureSmartySetup();
			$this->smarty->assign('message', 'wrongPassword');
			$this->forwardFailureName = 'failure';
			return false;
		}
		
		//validamos el nuevo password y su verificacion
		if ($_POST['password'] != $_POST['password_compare']) {
			$this->failureSmartySetup();
			$this->smarty->assign('message', 'wrongPasswordComparison');
			$this->forwardFailureName = 'failure';
			return false;
		}
		
		if (!empty($_POST['password']))
			$this->entityParams['password'] = Common::md5($_POST['password']);
		
		$file = $_FILES['document_file'];
		if (!empty($file['name'])) {
			try {
				Common::ensureWritable(Document::getDocumentsPath());
			} catch (Exception $e) {
				$this->smarty->assign('message', $e->getMessage());
				$this->forwardFailureName = 'failure';
				return false;
			}
			$this->entityParams['realFilename'] = $file['name'];
			$this->entityParams['fileSize'] = $file['size'];
			$this->entity->extractFullText($file);
			//me fijo si es una extension valida
			$extension = Document::getFileExtensionType($file);
			//si no es valida, salgo con error
			if($extension == 0){
				$this->smarty->assign('error','true');
				$this->smarty->assign('entity',$_POST['entity']);
				$this->smarty->assign('entityId',$_POST['entityId']);
				$this->smarty->assign('password',$_POST['password']);
				$this->smarty->assign('requester',$_POST['requester']);
				$this->forwardFailureName = 'success';
				return false;
			}else
				$this->entityParams['type'] = Document::getFileExtensionType($file);
			
			$this->smarty->assign('uploadMessage','uploadsuccess');
		}
		
		//datos del usuario
		$user = Common::getLoggedUser();
		if(is_object($user)){
			$this->entityParams['userObjectType'] = get_class($user);
			$this->entityParams['userObjectId'] = $user->getId();
		}
		
		//TODO: ordenar uso del swfupload
//		//si no llega ningun archivo significa que la carga se realizo por swfUpload.
//		if(empty($_FILES["document_file"]['name'])) {
//			return $this->addParamsToForwards(array('id'=>$_POST['entityId'],'message'=>'uploadsuccess'), $mapping, 'success' . $_POST['entity']);
//		}
		
	}
	
	protected function postSave() {
		parent::postSave();
		
		//creo la relacion documento - entity
		if(!empty($_POST['entity'])){
			$entityClass = $_POST['entity'] . 'Document';
			if ( class_exists($entityClass) ) {
				$setMethod = 'set' . $_POST['entity'] . 'Id';
				$entity = new $entityClass;
				$entity->$setMethod($_POST['entityId'])->setDocumentId($this->entity->getId())->save();
				$this->smarty->assign('document',$entity);
				$this->smarty->assign('entity',$_POST['entity']);
				$this->smarty->assign('entityId',$_POST['entityId']);
			}
		}
		
		//armo el path para guardar el documento
		if(isset($_POST['module']))
			$destPath = Document::getDocumentsPath($_POST['module']);
		else
			$destPath = Document::getDocumentsPath();
		//si el directorio no existe lo creo
		if (!file_exists($destPath)) {
			mkdir($destPath);
		}
		
		$destPath .= $this->entity->getId();
		
		//si el archivo ya existe lo elimino
		if (!empty($_FILES['document_file']['name'])) {
			if (file_exists($this->entity->getFullyQualifiedFileName()))
				unlink($this->entity->getFullyQualifiedFileName());
		}
		
		if(move_uploaded_file($_FILES['document_file']['tmp_name'], $this->entity->getFullyQualifiedFileName()))
			$this->smarty->assign($success,true);
		
		/* Ver esto*/
		global $system;
  
		$saveOriginalFiles = $system["config"]["blog"]["documents"]["saveOriginalFiles"]["value"];

		if ($saveOriginalFiles == "YES")
			copy($file["tmp_name"],$destPath);
		  
		 $this->smarty->assign('success','true');
				$this->smarty->assign('entity',$_POST['entity']);
				$this->smarty->assign('entityId',$_POST['entityId']);
				$this->smarty->assign('password',$_POST['password']);
				$this->smarty->assign('requester',$_POST['requester']);
		 
	}
}
