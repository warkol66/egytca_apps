<?php

/**
* DocumentsEditAction
*
* Action que permite ver los datos correspondientes de un documento que pueden modificarse
*
* @package documents
*/

class DocumentsEditAction extends BaseEditAction {
	
	public function __construct() {
		parent::__construct('Document');
	}
	
	protected function preEdit() {
		$module = "Documents";
		$this->smarty->assign('module', $module);

		$user = Common::getAdminLogged();
		
		$this->smarty->assign('user', $user);		
		$this->smarty->assign('categories', CategoryQuery::getAllParentsByUserAndModule($user, $module));
		$this->smarty->assign('documentsUpload', true); //en el template se realizan subidas de documentos
		$this->smarty->assign('documentTypes', Document::getDocumentsTypesConfig());
		$this->smarty->assign('maxUploadSize', Common::maxUploadSize());

		$moduleConfig = Common::getModuleConfiguration($module);
		if ($moduleConfig['usePasswords']['value'] == 'YES')
			$usePasswords = true;
		$this->smarty->assign('usePasswords', $usePasswords);
		
		$this->smarty->assign('generalParentCategories', $user->getDocumentsGeneralParentCategories());
		$this->smarty->assign('parentCategories', $user->getDocumentsParentCategories());
		
		parent::preEdit();
	}
	
	protected function postEdit() {
		parent::postEdit();
		
		//password enviado desde el listado
		$password = $_POST['password'];
		
		if ($this->entity->isPasswordProtected() && !$this->entity->checkPassword($password))
			return false;
			
		//si es edicion de documento existente verifico que el usuario logueado tenga mas permisos que el que creo el documento
		if(!$this->entity->isNew()){
			$logged = Common::getLoggedUser();
			$queryClass = $this->entity->getUserObjectType() . 'Query';
			if ( class_exists($queryClass) ) {
				$author = $queryClass::create()->findOneById($this->entity->getUserObjectId());
				//si no es administrador o no es el creador no lo dejo editar
				if($logged->getLevelId() > 2 || (get_class($logged) == get_class($author) && $logged->getId() == $author->getId())){
					$this->smarty->assign('level',true);
					$this->forwardFailureName = 'success';
					return false;
				}
			}
		}
		
		$this->smarty->assign('entity', $_POST['entity']);
		$this->smarty->assign('entityId', $_POST['entityId']);
	}
}
