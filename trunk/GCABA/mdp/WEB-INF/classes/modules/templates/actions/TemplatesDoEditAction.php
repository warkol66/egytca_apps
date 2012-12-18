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
	
	protected function preUpdate() {
		parent::preUpdate();
		
		//seteo nombre y size
		if (!$_FILES["document_file"]['name'] == '') {
			$this->entityParams['realFilename'] = $_FILES["document_file"]['name'];
			$this->entityParams['size'] = $_FILES["document_file"]['size'];
		}
		
	}
	
	protected function postUpdate() {
		parent::postUpdate();
		
		$module = "Templates";
		$this->smarty->assign("module",$module);

		global $appDir;
		$templatesPath = realpath($appDir . '/WEB-INF/templates/');

		if (!move_uploaded_file($_FILES["document_file"]['tmp_name'], $templatesPath . "/" . $this->entity->getId()))
			$this->smarty->assign("message", "uploadeFailure");

		$this->forwardName = "success";

	}
	
}