<?php
/**
* DocumentsDoEditAction
*
*  Action que genera un cambio de estado en la base de datos, le llegan datos de
*  un documento y los actualiza en dicha base de datos.
* 
* @package documents
*/

class DocumentsDoEditAction extends BaseDoEditAction {
	
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
		
		$this->smarty->assign('module', 'Documents');
		
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
			
			$this->params['message'] = 'uploadsuccess';
		}
		
		if ($this->entity->isNew() && !empty($_POST['entity'])) {
			
			$this->params['id'] = $_POST['entityId'];
			$this->forwardName = 'success'.$_POST['entity'];
			
			$addMethod = 'add' . $_POST['entity'];
			if ( method_exists($this->entity, $addMethod) && !empty($_POST['entityId']) ) {
				$queryClass = $_POST['entity'] . 'Query';
				if ( class_exists($queryClass) ) {
					$entity = $queryClass::create()->findOneById($_POST['entityId']);
					$this->entity->$addMethod($entity);
					return;
				}
			}
			
			$this->params['errormessage'] = 'documentUploadError';
			$this->forwardFailureName = 'failureUpload'.$_POST['entity'];
			return false;
		}
		
		$this->forwardName = 'success'.$_POST['entity'];
		
		if (!$this->entity->isNew()) {
			unset($this->entityParams['userObjectType']);
			unset($this->entityParams['userObjectId']);
		}
		//datos del usuario
/*		$user = Common::getLoggedUser();
		if($this->entity->isNew() && is_object($user)) {
			$this->entityParams['userObjectType'] = get_class($user);
			$this->entityParams['userObjectId'] = $user->getId();
		}
*/		
		//TODO: ordenar uso del swfupload
//		//si no llega ningun archivo significa que la carga se realizo por swfUpload.
//		if(empty($_FILES["document_file"]['name'])) {
//			return $this->addParamsToForwards(array('id'=>$_POST['entityId'],'message'=>'uploadsuccess'), $mapping, 'success' . $_POST['entity']);
//		}
		
	}
	
	protected function postSave() {
		parent::postSave();
		
		if (!empty($_FILES['document_file']['name'])) {
			if (file_exists($this->entity->getFullyQualifiedFileName()))
				unlink($this->entity->getFullyQualifiedFileName());
			move_uploaded_file($_FILES['document_file']['tmp_name'], $this->entity->getFullyQualifiedFileName());
		}
	}
}
